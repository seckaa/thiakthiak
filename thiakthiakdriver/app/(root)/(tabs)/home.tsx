import { useAuth, useUser } from "@clerk/clerk-expo";
import * as Location from "expo-location";
import React, { useState, useEffect, useContext, useRef } from "react";

import { fetchAPI, useFetch } from "@/lib/fetch";
import {
  Text,
  View,
  Alert,
  TouchableOpacity,
  Button,
  Image,
  ActivityIndicator,
} from "react-native";
import { useDriverLocationStore, useRideStore } from "@/store/driver";
import { Driver, Ride } from "@/types/type";
import { useDriverStatus } from "@/store";
import CustomButton from "@/components/CustomButton";
import SocketContext from "@/contexts/SocketContext";
import EVENTS from "@/config/events";
import BottomSheet, { BottomSheetView } from "@gorhom/bottom-sheet";
import { FlatList, GestureHandlerRootView } from "react-native-gesture-handler";
import { icons, images } from "@/constants";
import DriverMap from "@/components/driver/DriverMap";
import RideCard from "@/components/RideCard";
import { Href, router } from "expo-router";
import { updateDriverStatus } from "@/lib/utils";

function home() {
  const [hasPermission, setHasPermission] = useState<boolean>(false);
  const { tripStatus, setTripStatus } = useDriverStatus();
  const { user } = useUser();
  const {
    setDriverLocation,
    setDriverDestinationLocation,
    driverLongitude,
    driverLatitude,
  } = useDriverLocationStore();
  const useRideStorage = useRideStore();
  const { ride, setRide, setLoading, setError } = useRideStorage;
  let location;
  const { socket, uid, users } = useContext(SocketContext).SocketState;
  const userId = user?.id;
  const bottomSheetRef = useRef<BottomSheet>(null);
  const {
    data: recentRides,
    loading,
    error,
    refetch,
  } = useFetch<Ride[]>(`/(api)/driver/ride/rides?id=${userId}`);
  const [driverInfo, setDriverInfo] = useState<Driver | null>(null);
  // Function to emit event with object to socket server
  const sendMessage = (event: string, payload?: Object) => {
    socket?.emit(event, { payload, uid, users });
  };

  async function notifyUser(status: string) {
    sendMessage(EVENTS.CLIENT.PRIVATE_MESSAGE, {
      status: status,
      // driverId: selectedDriver,
      user: user?.id,
    });
  }

  //checkPermissions
  const checkPermissions = async () => {
    const { status } = await Location.requestForegroundPermissionsAsync();
    if (status !== "granted") {
      setHasPermission(false);
      Alert.alert(
        "Permission Denied",
        "Location permissions are required to use this feature."
      );
      return;
    }
    setHasPermission(true);
  };

  //fetchRideData
  const fetchRideData = async () => {
    if (user?.id) {
      setLoading(true);
      try {
        const response = await fetch(`/(api)/driver/ride/${user?.id}`);
        if (response.status !== 200) {
          setError("Unable to fetch data");
          throw new Error("Unable to fetch data");
        } else {
          const data = await response.json();
          const convertedData = data.data.map((item: Ride) => ({
            ...item,
            origin_latitude: Number(item.origin_latitude),
            origin_longitude: Number(item.origin_longitude),
            destination_latitude: Number(item.destination_latitude),
            destination_longitude: Number(item.destination_longitude),
          }));

          setRide(convertedData[0]);
          updateDriverStorage();
        }
      } catch (error) {
        setError("Server error, please contact admin");
      } finally {
        setLoading(false);
      }
    }
  };

  //update driverLocation n db
  async function updateDriverStorage() {
    checkPermissions();
    location = await Location.getCurrentPositionAsync({});
    const address = await Location.reverseGeocodeAsync({
      latitude: location.coords?.latitude,
      longitude: location.coords?.longitude,
    });

    console.log("location", location);
    //driver locale storage
    if (user?.publicMetadata.accountType === "driver") {
      setDriverLocation({
        latitude: location.coords?.latitude,
        longitude: location.coords?.longitude,
        address: `${address[0].name}, ${address[0].region}`,
      });
      if (
        ride?.origin_latitude ||
        ride?.origin_longitude ||
        ride?.origin_address
      ) {
        setDriverDestinationLocation({
          latitude: ride?.origin_latitude,
          longitude: ride?.origin_longitude,
          address: ride?.origin_address,
        });
      }
    }

    // db storage
    try {
      setLoading(true);
      await fetchAPI(`/(api)/position/driver/${user?.id}`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          latitude: location.coords?.latitude,
          longitude: location.coords?.longitude,
        }),
      }).then((response) => {
        console.log("driver coordonate saved to db ", response);
        setLoading(false);
      });
    } catch (error) {
      console.log("Server error ", error);
      setLoading(false);
    }
  }

  // Handle driver online status
  const handleGoOnline = (status: string) => {
    if (!userId) return;
    try {
      updateDriverStatus(userId, status);
      setTripStatus(status);
      console.log(tripStatus);
      refetch;
      router.replace("/(root)/ready-trip");

      setLoading(false);
    } catch (error) {
      console.error("Error updating driver status:", error);
      setError("Server error, please contact admin");
    } finally {
      setLoading(false);
    }
  };
  // Handle driver offline status
  const handleGoOffline = (status: string) => {
    if (!userId) return;
    setLoading(true);
    try {
      updateDriverStatus(userId, status);
      setTripStatus(status);
      console.log(tripStatus);
      refetch;
      router.replace("/(root)/home");
      setLoading(false);
    } catch (error) {
      console.error("Error updating driver status:", error);
      setError("Server error, please contact admin");
    } finally {
      setLoading(false);
    }
  };

  const fetchDriverStatus = async () => {
    setLoading(true);
    try {
      const response = await fetch(`/(api)/driver/status`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: userId }),
      });

      if (!response.ok) {
        const { error } = await response.json();
        throw new Error(error);
      }
      const { data } = await response.json();
      //  setStatus(data);
      setLoading(false);
      return data.status;
    } catch (err) {
      // setError(err.message);
      console.log(err);
    } finally {
      setLoading(false);
    }
  };

  //fetchStatus n update store
  useEffect(() => {
    setLoading(true);
    // Update trip status on mount
    const fetchStatus = async () => {
      const status = await fetchDriverStatus();

      console.log("Fetched status:", status); // Log the fetched status

      setTripStatus(String(status));
      setLoading(false);
    };
    fetchStatus();
    setLoading(false);
  }, []);

  //handle pages based on tripstatus
  useEffect(() => {
    setLoading(true);
    console.log("useEffect triggered with tripStatus:", tripStatus); // Log to check when useEffect is triggered

    const handleRedirection = (status: string, path: Href) => {
      console.log(`Redirecting to ${path}`); // Log just before redirecting
      router.push(path);
    };

    switch (tripStatus) {
      case "ready":
        handleRedirection(tripStatus, "/(root)/ready-trip");
        setLoading(false);
        break;
      case "taken":
        handleRedirection(tripStatus, "/(root)/taken-trip");
        setLoading(false);
        break;
      case "onDuty":
        handleRedirection(tripStatus, "/(root)/onduty-trip");
        setLoading(false);
        break;
      case "paused":
        handleRedirection(tripStatus, "/(root)/paused-trip");
        setLoading(false);
        break;
      // case "touser":
      //   handleRedirection(tripStatus, "/(root)/touser-trip");
      //   break;
      default:
        console.log("Unhandled trip status:", tripStatus);
        setLoading(false);
    }

    console.log("Current tripStatus:", tripStatus); // Log the current trip status
  }, [tripStatus, router]);

  //fetchDriverInfo
  const fetchDriverInfo = async (userId: string) => {
    try {
      const response = await fetch(`/(api)/driver/myinfo`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: userId }),
      });

      if (!response.ok) {
        const { error } = await response.json();
        throw new Error(error);
      }

      const { data } = await response.json();
      return data;
    } catch (err) {
      console.log("Error fetching driver info:", err);
      throw err; // rethrow the error if needed
    }
  };

  //driver info
  useEffect(() => {
    const getUserInfo = async () => {
      try {
        const data = await fetchDriverInfo(userId!);
        setDriverInfo(data);
        setTripStatus(data.status);
        console.log("driverInfo from info:", data.status);
      } catch (error) {
        console.log(error);
      } finally {
        setLoading(false);
      }
    };
    // getUserInfo();
  }, []);

  // updateDriverStorage fetchRideData
  useEffect(() => {
    (async () => {
      updateDriverStorage();
      fetchRideData();
      // const intervalId = setInterval(fetchRideData, 300000); // 300000 ms = 5 minutes
      // return () => clearInterval(intervalId); // Clean up interval on component unmount
    })();
  }, [location, user, userId]);

  const renderOfflineView = () => (
    <>
      <View className="flex flex-col h-1/2 bg-blue-500">
        <View className="flex flex-row absolute left-[30%] z-10 top-[70%] items-center justify-start">
          <TouchableOpacity
            onPress={() => {
              handleGoOnline("ready");
            }}
            className="flex flex-row items-center justify-start"
          >
            <Text className="text-white text-2xl font-JakartaExtraBold mr-2">
              Go Online
            </Text>
            <View className="w-10 h-10 bg-green-500 rounded-full items-center justify-center">
              <Image
                source={icons.arrowUp}
                resizeMode="contain"
                className="w-6 h-6 rotate-90"
              />
            </View>
          </TouchableOpacity>
        </View>
      </View>
      <BottomSheet ref={bottomSheetRef} snapPoints={["55%", "80%"]} index={0}>
        <BottomSheetView style={{ flex: 1, padding: 20 }}>
          <View className="flex flex-col mb-10">
            <TouchableOpacity
              onPress={() => router.push("/(root)/(tabs)/home")}
              className="flex flex-row absolute z-10 top-0 items-center justify-end"
            ></TouchableOpacity>
          </View>

          <>
            <Text className="text-xl font-JakartaMedium">
              Go online to receive orders
            </Text>

            <FlatList
              data={recentRides?.slice(0, 1)}
              renderItem={({ item }) => <RideCard ride={item} />}
              keyExtractor={(item, index) => index.toString()}
              className="px-5"
              keyboardShouldPersistTaps="handled"
              contentContainerStyle={{
                paddingBottom: 100,
              }}
              ListEmptyComponent={() => (
                <View className="flex flex-col items-center justify-center">
                  {!loading ? (
                    <>
                      <Image
                        source={images.noResult}
                        className="w-40 h-40"
                        alt="No recent rides found"
                        resizeMode="contain"
                      />
                      <Text className="text-sm">No recent rides found</Text>
                    </>
                  ) : (
                    <ActivityIndicator size="small" color="#000" />
                  )}
                </View>
              )}
              ListHeaderComponent={
                <>
                  <Text className="text-2xl font-JakartaBold my-5">
                    Last Trip details
                  </Text>
                </>
              }
            />
          </>
        </BottomSheetView>
      </BottomSheet>
    </>
  );

  const renderOnlineView = () => (
    <>
      <View className="flex flex-col h-1/2 bg-blue-500">
        <View className="flex flex-col absolute left-[30%] z-10 top-[70%] items-center justify-start">
          <TouchableOpacity
            onPress={() => {
              handleGoOffline("offline");
            }}
            className="flex flex-row items-center justify-start"
          >
            <View className="w-10 h-10 bg-red-200 rounded-full items-center justify-center">
              <Image
                source={icons.arrowUp}
                resizeMode="contain"
                className="w-6 h-6 -rotate-90"
              />
            </View>
            <Text className="text-2xl font-JakartaBold ml-2 text-red-600">
              Go Offline
            </Text>
          </TouchableOpacity>
          <Text className="text-sm bg-white text-green-500 px-5 mt-1 rounded-full">
            Now Taking trips
          </Text>
        </View>
        <DriverMap />
      </View>
      <BottomSheet ref={bottomSheetRef} snapPoints={["55%", "80%"]} index={0}>
        <BottomSheetView style={{ flex: 1, padding: 20 }}>
          {/* <View className="flex flex-col mb-10">
                <TouchableOpacity
                  onPress={() => router.push("/(root)/(tabs)/home")}
                  className="flex flex-row absolute z-10 top-0 items-center justify-end"
                ></TouchableOpacity>
              </View> */}

          <View className=" items-center justify-center flex flex-col">
            <View className="text-xl font-JakartaExtraBold mb-4 flex flex-row gap-1 justify-center items-center">
              <>
                <Text>Status</Text>
                <Text>:</Text>
                <Text className="text-xl text-orange-300">Paused</Text>
              </>
            </View>
            <CustomButton
              title="Back to Ready"
              onPress={() => {
                router.push("/(root)/ready-trip");
              }}
              className="bg-green-400"
            />
            <Text className="text-xl font-JakartaBold mt-5 mb-3">
              Trip Info:{ride?.destination_address}
            </Text>
          </View>
        </BottomSheetView>
      </BottomSheet>
    </>
  );

  const renderPausedView = () => (
    <>
      <View className="flex flex-col h-1/2 bg-blue-500">
        <View className="flex flex-col absolute left-[30%] z-10 top-[70%] items-center justify-start">
          <TouchableOpacity
            onPress={() => {
              handleGoOnline("ready");
            }}
            className="flex flex-row items-center justify-start"
          >
            <View className="w-10 h-10 bg-red-200 rounded-full items-center justify-center">
              <Image
                source={icons.arrowUp}
                resizeMode="contain"
                className="w-6 h-6 -rotate-90"
              />
            </View>
            <Text className="text-2xl font-JakartaBold ml-2 text-red-600">
              Go ready
            </Text>
          </TouchableOpacity>
          <Text className="text-sm bg-white text-green-500 px-5 mt-1 rounded-full">
            paused state
          </Text>
        </View>
        <DriverMap />
      </View>
      <BottomSheet ref={bottomSheetRef} snapPoints={["55%", "80%"]} index={0}>
        <BottomSheetView style={{ flex: 1, padding: 20 }}>
          {/* <View className="flex flex-col mb-10">
                <TouchableOpacity
                  onPress={() => router.push("/(root)/(tabs)/home")}
                  className="flex flex-row absolute z-10 top-0 items-center justify-end"
                ></TouchableOpacity>
              </View> */}

          <View className=" items-center justify-center flex flex-col">
            <View className="text-xl font-JakartaExtraBold mb-4 flex flex-row gap-1 justify-center items-center">
              <>
                <Text>Status</Text>
                <Text>:</Text>
                <Text className="text-xl text-orange-300">Paused</Text>
              </>
            </View>
            <CustomButton
              title="Back to Ready"
              onPress={() => {
                handleGoOnline("ready");
                // router.push("/(root)/ready-trip");
              }}
              className="bg-green-400"
            />
            {/* <Text className="text-xl font-JakartaBold mt-5 mb-3">
              Trip Info:{ride?.destination_address}
            </Text> */}
          </View>
        </BottomSheetView>
      </BottomSheet>
    </>
  );

  // if (loading)
  //   return (
  //     <ActivityIndicator
  //       className="flex flex-1 justify-center items-center"
  //       size="large"
  //       color="#0000ff"
  //     />
  //   );

  if (loading || (!driverLongitude && !driverLongitude))
    return (
      <View className="flex justify-between items-center w-full">
        <ActivityIndicator size="small" color="#000" />
      </View>
    );

  // Display error message if there is an error
  if (error)
    return (
      <View className="flex justify-between items-center w-full">
        <Text>Error: {error}</Text>
      </View>
    );

  return (
    <GestureHandlerRootView className="flex-1">
      <View className="flex-1 bg-white">
        {renderOfflineView()}
        {/* {tripStatus === "offline" ? renderOfflineView() : renderPausedView()} */}
        {/* {tripStatus === "offline"
          ? renderOfflineView()
          : tripStatus === "ready"
            ? renderOnlineView()
            : renderPausedView()} */}
      </View>
    </GestureHandlerRootView>
  );
}

export default home;
