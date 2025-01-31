import CustomButton from "@/components/CustomButton";
import DriverLayout from "@/components/driver/DriverLayout";
import EVENTS from "@/config/events";
import SocketContext from "@/contexts/SocketContext";
import { updateDriverStatus } from "@/lib/utils";
import { useDriverStatus } from "@/store";
import { useDriverLocationStore, useRideStore } from "@/store/driver";
import { useUser } from "@clerk/clerk-expo";
import { Href, useRouter } from "expo-router";
import React, { useContext, useEffect, useRef } from "react";
import { Platform, Text, View } from "react-native";
import * as Notifications from "expo-notifications";
import "react-native-get-random-values";
import { v4 as uuidv4 } from "uuid";

function Ready() {
  const { user } = useUser();
  const userId = user?.id;
  const useRideStorage = useRideStore();
  const { ride, setRide, setLoading, setError, loading, error } =
    useRideStorage;
  const { driverLatitude, driverLongitude } = useDriverLocationStore();
  const { tripStatus, setTripStatus } = useDriverStatus();
  const { socket, uid, users } = useContext(SocketContext).SocketState;
  // const hasRedirected = useRef(false); // Create a ref to track redirection
  const hasScheduled = useRef(false);
  const router = useRouter(); // Use useRouter from expo-router
  // const BACKGROUND_FETCH_TASK = "background-fetch-task";
  const BACKGROUND_FETCH_TASK = "background-fetch";

  const handlePausedOrOfflineStatus = (status: string, route: Href) => {
    if (!userId) return;
    setLoading(true);
    try {
      if (tripStatus === "ready") {
        setTripStatus(status);
        updateDriverStatus(userId, status);

        console.log("tripStatus", tripStatus);
        router.replace(route);
      } else {
        alert("complete trip activities first");
      }

      setLoading(false);
    } catch (error) {
      console.error("Error updating driver status:", error);
      setError("Server error, please contact admin");
    } finally {
      setLoading(false);
    }
  };

  // Function to emit event with object to socket server
  const sendMessage = (event: string, payload?: Object) => {
    socket?.emit(event, { payload, uid, users });
  };

  async function notifyUser(status: string) {
    sendMessage(EVENTS.CLIENT.PRIVATE_MESSAGE, {
      status: status,
      driverId: 3,
      user: user?.id,
    });
  }

  //simple notification
  // const scheduleNotification = async () => {
  //   try {
  //     await Notifications.scheduleNotificationAsync({
  //       content: {
  //         title: "Test Notification",
  //         body: "This is a test notification.",
  //         sound: true,
  //       },
  //       trigger: { seconds: 5 },
  //       // Schedule for 5 seconds later
  //     });
  //     console.log("Test notification scheduled");
  //   } catch (error) {
  //     console.log("Error scheduling test notification:", error);
  //   }
  // };
  const scheduleNotification = async () => {
    console.log("scheduleNotification is called");
    if (hasScheduled.current) return; // Prevent multiple scheduling
    hasScheduled.current = true;

    try {
      // const asset = Asset.fromModule(require("../../assets/images/check.png"));
      // await asset.downloadAsync();
      // const imageUri = asset.localUri || asset.uri;
      const publicImageUrl = "https://via.placeholder.com/150";

      console.log("Image URI:", publicImageUrl); // Log the image URI

      await Notifications.scheduleNotificationAsync({
        content: {
          title: "New Order Received",
          body: "You have a new order. Tap to view details.",
          sound: true,
          // data: { url: "https://example.com/order-details" }, // Add your URL here
          data: { route: "/(root)/touser-trip" }, // Include your app route here
          attachments: publicImageUrl
            ? [
                {
                  identifier: "image",
                  url: publicImageUrl,
                  // type: "image/jpeg", // Add the type property for iOS attachments
                  type: "image/jpeg", // Add the type property for iOS attachments
                  // Only include identifier and url for iOS attachments
                },
              ]
            : [],
        },
        trigger: null, // Immediate trigger
        // trigger: { seconds: 5 },
        identifier: uuidv4(), // Unique identifier for each notification
      });
    } catch (error) {
      console.log("Error scheduling notification:", error);
    }
    // Reset the flag after a short delay to allow future notifications
    setTimeout(() => {
      hasScheduled.current = false;
    }, 10000); // Adjust time as needed
  };

  //requestPermissions
  const requestPermissions = async () => {
    try {
      const { status } = await Notifications.requestPermissionsAsync();
      console.log("Notification permissions status:", status);
      if (status !== "granted") {
        alert("Permission to access notifications was denied");
      }
    } catch (error) {
      console.log(error);
    }
  };

  //permission, Configure how notifications are handled in the foreground,
  //Add listener to log received notifications
  useEffect(() => {
    // Configure how notifications are handled in the foreground
    Notifications.setNotificationHandler({
      handleNotification: async () => ({
        shouldShowAlert: true,
        shouldPlaySound: true,
        shouldSetBadge: true,
      }),
    });
    requestPermissions();

    if (Platform.OS === "android") {
      Notifications.setNotificationChannelAsync("default", {
        name: "default",
        importance: Notifications.AndroidImportance.MAX,
        sound: "default",
        vibrationPattern: [0, 250, 250, 250],
        lightColor: "#FF231F7C",
      })
        .then((channel) => {
          console.log("Notification channel set:", channel);
        })
        .catch((err) => {
          console.log("Error setting notification channel:", err);
        });
    }
    // Add listener to log received notifications
    const subscription = Notifications.addNotificationReceivedListener(
      (notification) => {
        console.log("Notification received:", notification, Date());
      }
    );
    return () => subscription.remove();
  }, []);

  //handleNotificationResponse
  useEffect(() => {
    const handleNotificationResponse = (
      response: Notifications.NotificationResponse
    ) => {
      // const url = response.notification.request.content.data.url;
      // if (url) {
      //   // Open the URL
      //   Linking.openURL(url);
      // }

      const route = response.notification.request.content.data.route;
      if (route) {
        router.push(route); // Navigate to the specified route when notification is tapped
      }
    };

    const subscription = Notifications.addNotificationResponseReceivedListener(
      handleNotificationResponse
    );

    return () => subscription.remove();
  }, []);

  useEffect(() => {
    requestPermissions();
    if (socket) {
      socket.on("3" + "status", (payload) => {
        try {
          console.log("received something", payload);
          const data = payload;

          // const driverId = data?.payload?.driverId;
          // const user = data?.payload?.user;
          // const status = data?.payload?.status;

          // Extract the payload carefully
          const { driverId, status, user } = payload;
          if (status) {
            setTripStatus(status);
            console.log("Driver TripStatus set to:", status); // Log the new status
          } else {
            console.warn("Status not found in payload:", payload); // Log if status is not found
          }

          // sendMessage(EVENTS.CLIENT.PRIVATE_MESSAGE, {
          //   status: "taken",
          //   driverId: 9,
          //   user: user?.id,
          // });

          scheduleNotification();
        } catch (error) {
          console.error("Error handling socket payload:", error);
        }
      });
      socket.on("3" + "order", (payload) => {
        try {
          console.log("received something", payload);
          const { driverId, status, user, rideInfo } = payload;
          if (status) {
            setTripStatus(status);
            setRide(rideInfo);
            console.log("Driver TripStatus set to:", payload); // Log the new status
          } else {
            console.warn("Status not found in payload:", payload); // Log if status is not found
          }
          scheduleNotification();
        } catch (error) {
          console.error("Error handling socket payload:", error);
        }
      });
      socket.on("error", (error) => {
        console.error("Socket error:", error);
      });
    }
    // const fetchStatus = async () => {
    //   console.log("Driver statken after been selected or release", tripStatus);

    //   // console.log("Fetched tripStatus:", tripStatus);
    //   // setTripStatus(status);
    //   // if (tripStatus === "taken") {
    //   // console.log("Playing sound for new order");
    //   // const soundObject = new Audio.Sound();
    //   // try {
    //   //   await soundObject.loadAsync(require("./sounds/notification.mp3"));
    //   //   // Use require to load the sound file
    //   //   await soundObject.playAsync();
    //   // } catch (error) {
    //   //   console.log("Error playing sound:", error);
    //   // }
    //   // }
    // };

    // fetchStatus();

    return () => {
      if (socket) {
        socket.off("3" + "status", () => {});
      }
      if (socket) {
        socket.off("3" + "order", () => {});
      }
    };
  }, [socket, setTripStatus]);
  // useEffect(() => {
  //   requestPermissions();
  //   if (socket) {
  //     const handleStatusChange = (payload: Payload) => {
  //       try {
  //         console.log("received something", payload);
  //         const { status } = payload;
  //         if (status) {
  //           setTripStatus(status);
  //           console.log("Driver TripStatus set to:", status); // Log the new status
  //         } else {
  //           console.warn("Status not found in payload:", payload); // Log if status is not found
  //         }
  //         scheduleNotification();
  //       } catch (error) {
  //         console.error("Error handling socket payload:", error);
  //       }
  //     };
  //     const handleOrder = (payload: Payload) => {
  //       try {
  //         console.log("received something", payload);
  //         const { status, rideInfo } = payload;
  //         if (status) {
  //           setTripStatus(status);
  //           setRide(rideInfo!);
  //           console.log("Driver TripStatus set to:", payload); // Log the new status
  //         } else {
  //           console.warn("Status not found in payload:", payload); // Log if status is not found
  //         }
  //         scheduleNotification();
  //       } catch (error) {
  //         console.error("Error handling socket payload:", error);
  //       }
  //     };
  //     socket.on("3status", handleStatusChange);
  //     socket.on("3order", handleOrder);
  //     return () => {
  //       socket.off("3status", handleStatusChange);
  //       socket.off("3order", handleOrder);
  //     };
  //   }
  // }, [socket, setTripStatus]);

  return (
    <DriverLayout
      title={"Waiting screen"}
      snapPoints={["40%", "85%"]}
      onPress={() => {
        router.back();
      }}
    >
      <View>
        <View>
          <Text className="text-center text-xl font-JakartaExtraLight pb-10">
            No trip at this moment
          </Text>
        </View>
        <View className="flex flex-col gap-4">
          <View className="flex flex-row justify-between">
            <CustomButton
              title="Break"
              onPress={() => {
                handlePausedOrOfflineStatus("paused", "/(root)/paused-trip");
              }}
              className="w-[100px] bg-blue-300"
            ></CustomButton>
            <CustomButton
              title="Offline"
              onPress={() => {
                handlePausedOrOfflineStatus("offline", "/(root)/home");
              }}
              className="w-[100px] bg-orange-400"
            ></CustomButton>
          </View>
          {/* {ride?.origin_address ? (
            <CustomButton
              title="Start Navigation"
              onPress={() => {
                destinationopenGoogleMapsNavigation(
                  driverLatitude!,
                  driverLongitude!,
                  ride?.origin_latitude!,
                  ride?.origin_longitude!
                );
              }}
              className="bg-blue-500"
            />
          ) : (
            <>
              <Text className="text-center text-xl font-JakartaExtraLight pb-10">
                No rides at this moment
              </Text>
            </>
          )} */}
          {/* {!ride?.origin_address && ( */}
          {/* <View className="flex flex-row justify-between">
            <CustomButton
              title="Break"
              onPress={() => {
                handlePausedOrOfflineStatus("paused");
              }}
              className="w-[100px] bg-blue-300"
            ></CustomButton>
            <CustomButton
              title="Offline"
              onPress={() => {
                handlePausedOrOfflineStatus("offline");
              }}
              className="w-[100px] bg-orange-400"
            ></CustomButton>
          </View> */}
          {/* )} */}
        </View>
      </View>
    </DriverLayout>
  );
}

export default Ready;
