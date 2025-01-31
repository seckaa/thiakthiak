import { useUser } from "@clerk/clerk-expo";
import { StripeProvider } from "@stripe/stripe-react-native";
import React, {
  Alert,
  BackHandler,
  Image,
  Text,
  TouchableOpacity,
  View,
} from "react-native";

import Payment from "@/components/Payment";
import RideLayout from "@/components/RideLayout";
import { icons } from "@/constants";
import { formatTime, updateDriverStatus } from "@/lib/utils";
import { useDriverStore, useIsCashStore, useLocationStore } from "@/store";
import { useNavigation } from "@react-navigation/native";
import { useContext, useEffect, useRef, useState } from "react";
import SocketContext from "@/contexts/SocketContext";
import EVENTS from "@/config/events";

const BookRide = () => {
  const { user } = useUser();
  const { userAddress, destinationAddress } = useLocationStore();
  const { drivers, selectedDriver } = useDriverStore();
  const { isCash, setIsCash } = useIsCashStore();
  const driverDetails = drivers?.filter(
    (driver) => +driver.id === selectedDriver
  )[0];
  const navigation = useNavigation();
  const idleTimeoutRef = useRef<NodeJS.Timeout | null>(null);
  // const alertTimeoutRef = useRef<NodeJS.Timeout | null>(null);

  const { socket, uid, users } = useContext(SocketContext).SocketState;

  // Function to emit event with object to socket server
  const sendMessage = (event: string, payload?: Object) => {
    socket?.emit(event, { payload, uid, users });
  };

  async function notifyRider(status: string) {
    sendMessage(EVENTS.CLIENT.PRIVATE_MESSAGE, {
      status: status,
      driverId: selectedDriver,
      user: user?.id,
    });
  }

  async function penalizeUser() {
    try {
      // Update user's bank account balance
      await fetch("/(api)/bank/user/update-balance", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          clerk_id: user?.id,
          tripAmount: 300.0,
        }),
      });

      console.log("User penalized");

      //chnage balance
    } catch (error) {
      console.error("Error updating bank balance:", error);
    }
  }

  // Function to handle back button press
  const handleBackPress = () => {
    Alert.alert(
      "Confirmation",
      "Do you want to go back because? \nThere is a 300.00 Fcfa cancel fee",
      [
        { text: "Cancel", onPress: () => null, style: "cancel" },
        {
          text: "YES",
          onPress: async () => {
            if (selectedDriver) {
              await updateDriverStatus(selectedDriver, "ready");
              // await penalizeUser();
              notifyRider("ready");
            }
            // setbackclick(false);
            navigation.goBack();
          },
        },
      ]
    );
    // alertTimeoutRef.current = setTimeout(() => {
    //   if (selectedDriver) {
    //     updateDriverStatus("ready");
    //   }
    //   // navigation.goBack();
    //   router.push("/(root)/find-ride");
    // }, 10000); // 10 seconds
    return true; // Prevent default behavior
  };

  // Start idle timeout
  const startIdleTimeout = () => {
    if (idleTimeoutRef.current) {
      clearTimeout(idleTimeoutRef.current);
    }
    idleTimeoutRef.current = setTimeout(() => {
      handleBackPress();
    }, 10000); // 120000 ms = 2 minutes };
  };
  useEffect(() => {
    // Add event listener for back button press
    BackHandler.addEventListener("hardwareBackPress", handleBackPress);

    // Start idle timeout on mount
    // startIdleTimeout();

    // Cleanup the event listener on component unmount
    return () => {
      BackHandler.removeEventListener("hardwareBackPress", handleBackPress);
      if (idleTimeoutRef.current) {
        clearTimeout(idleTimeoutRef.current);
      }
      // if (alertTimeoutRef.current) {
      //   clearTimeout(alertTimeoutRef.current);
      // }
    };
  }, [BackHandler]);

  return (
    <StripeProvider
      publishableKey={process.env.EXPO_PUBLIC_STRIPE_PUBLISHABLE_KEY!}
      merchantIdentifier="merchant.com.uber"
      urlScheme="myapp" // must match the `urlScheme` in your app.json
    >
      <RideLayout
        title="Book Ride"
        // onPress={() => {
        //   if (selectedDriver) {
        //     updateDriverStatus("ready");
        //   }
        //   router.push("/(root)/find-ride");
        // }}
        onPress={handleBackPress}
      >
        <>
          <>
            <Text className="text-xl font-JakartaSemiBold mb-3">
              Ride Information
            </Text>
            <View className="flex flex-row justify-end items-center ">
              <TouchableOpacity
                onPress={() => {
                  if (!isCash) {
                    setIsCash(true);
                  }
                }}
              >
                <Text className=" rounded-full text-l px-2 pb-1 bg-green-600 text-white font-JakartaSemiBold">
                  Cash
                </Text>
              </TouchableOpacity>

              <Text className="font-JakartaSemiBold mx-1 pb-1">|</Text>

              <TouchableOpacity
                onPress={() => {
                  if (!isCash) {
                    return;
                  }
                  setIsCash(false);
                }}
              >
                <Text className=" rounded-full text-l px-2 pb-1 bg-orange-500 text-white font-JakartaSemiBold">
                  Digital
                </Text>
              </TouchableOpacity>
            </View>
          </>

          {/* <View className="flex flex-col w-full items-center justify-center mt-10"> */}
          <View className="flex flex-col w-full items-center justify-center mt-0">
            {driverDetails?.profile_image_url && (
              <Image
                source={{ uri: driverDetails?.profile_image_url }}
                className="w-20 h-20 rounded-full"
              />
            )}

            <View className="flex flex-row items-center justify-center mt-5 space-x-2">
              <Text className="text-lg font-JakartaSemiBold">
                {driverDetails?.title}
              </Text>

              <View className="flex flex-row items-center space-x-0.5">
                <Image
                  source={icons.star}
                  className="w-5 h-5"
                  resizeMode="contain"
                />
                <Text className="text-lg font-JakartaRegular">
                  {driverDetails?.rating}
                </Text>
              </View>
            </View>
          </View>

          <View className="flex flex-col w-full items-start justify-center py-3 px-5 rounded-3xl bg-general-600 mt-5">
            <View className="flex flex-row items-center justify-between w-full border-b border-white py-3">
              <Text className="text-lg font-JakartaRegular">Ride Price</Text>
              <Text className="text-lg font-JakartaRegular text-[#0CC25F]">
                ${driverDetails?.price}
              </Text>
            </View>

            <View className="flex flex-row items-center justify-between w-full border-b border-white py-3">
              <Text className="text-lg font-JakartaRegular">Pickup Time</Text>
              <Text className="text-lg font-JakartaRegular">
                {/* {formatTime(driverDetails?.time!)} */}
                {formatTime(parseInt(`${driverDetails?.timeToUser}`))}
              </Text>
            </View>

            <View className="flex flex-row items-center justify-between w-full py-3">
              <Text className="text-lg font-JakartaRegular">Car Seats</Text>
              <Text className="text-lg font-JakartaRegular">
                {driverDetails?.car_seats}
              </Text>
            </View>
          </View>

          <View className="flex flex-col w-full items-start justify-center mt-5">
            <View className="flex flex-row items-center justify-start mt-3 border-t border-b border-general-700 w-full py-3">
              <Image source={icons.to} className="w-6 h-6" />
              <Text className="text-lg font-JakartaRegular ml-2">
                {userAddress}
              </Text>
            </View>

            <View className="flex flex-row items-center justify-start border-b border-general-700 w-full py-3">
              <Image source={icons.point} className="w-6 h-6" />
              <Text className="text-lg font-JakartaRegular ml-2">
                {destinationAddress}
              </Text>
            </View>
          </View>

          <Payment
            fullName={user?.fullName!}
            email={user?.emailAddresses[0].emailAddress!}
            amount={driverDetails?.price!}
            driverId={driverDetails?.id}
            rideTime={driverDetails?.time!}
            isCash={isCash}
          />
        </>
      </RideLayout>
    </StripeProvider>
  );
};

export default BookRide;
