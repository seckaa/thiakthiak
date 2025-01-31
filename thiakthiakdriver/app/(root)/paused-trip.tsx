import { useUser } from "@clerk/clerk-expo";
import React, { useEffect, useContext, useRef } from "react";

import {
  Text,
  View,
  TouchableOpacity,
  Image,
  ActivityIndicator,
} from "react-native";
import { useDriverLocationStore, useRideStore } from "@/store/driver";
import { useDriverStatus } from "@/store";
import CustomButton from "@/components/CustomButton";
import SocketContext from "@/contexts/SocketContext";
import BottomSheet, { BottomSheetView } from "@gorhom/bottom-sheet";
import { GestureHandlerRootView } from "react-native-gesture-handler";
import { icons } from "@/constants";
import DriverMap from "@/components/driver/DriverMap";
import { Href, router } from "expo-router";
import { updateDriverStatus } from "@/lib/utils";

function home() {
  const { tripStatus, setTripStatus } = useDriverStatus();
  const { user } = useUser();
  useDriverLocationStore();
  const useRideStorage = useRideStore();
  const { ride, setRide, setLoading, setError, loading } = useRideStorage;
  let location;
  const { socket, uid, users } = useContext(SocketContext).SocketState;
  const userId = user?.id;
  const bottomSheetRef = useRef<BottomSheet>(null);

  // Handle driver online status
  const handleGoOnline = (status: string) => {
    if (!userId) return;
    try {
      updateDriverStatus(userId, status);
      setTripStatus(status);
      console.log(tripStatus);
      router.replace("/(root)/ready-trip");

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
    // Update trip status on mount
    const fetchStatus = async () => {
      const status = await fetchDriverStatus();

      console.log("Fetched status:", status); // Log the fetched status

      setTripStatus(String(status));
    };
    fetchStatus();
  }, []);

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
                <Text className="text-xl text-orange-300 capitalize">
                  {tripStatus}
                </Text>
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

  if (loading)
    return (
      <ActivityIndicator
        className="flex flex-1 justify-center items-center"
        size="large"
        color="#0000ff"
      />
    );
  return (
    <GestureHandlerRootView className="flex-1">
      <View className="flex-1 bg-white">{renderPausedView()}</View>
    </GestureHandlerRootView>
  );
}

export default home;
