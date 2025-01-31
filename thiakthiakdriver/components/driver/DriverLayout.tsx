import BottomSheet, { BottomSheetView } from "@gorhom/bottom-sheet";
import { router } from "expo-router";
import React, { useEffect, useRef } from "react";
import {
  ActivityIndicator,
  FlatList,
  Image,
  Text,
  TouchableOpacity,
  TouchableOpacityProps,
  View,
} from "react-native";
import { GestureHandlerRootView } from "react-native-gesture-handler";
import { icons, images } from "@/constants";
import { useUser } from "@clerk/clerk-expo";
import { useRideStore } from "@/store/driver";
import { fetchAPI, useFetch } from "@/lib/fetch";
import { useDriverStatus } from "@/store";
import { Ride } from "@/types/type";
import DriverMap from "./DriverMap";
import RideCard from "../RideCard";
declare interface RideLayoutProps extends TouchableOpacityProps {
  title: string;
  snapPoints?: string[];
  children: React.ReactNode;
}

const DriverLayout = ({
  title,
  snapPoints,
  onPress,
  children,
}: RideLayoutProps) => {
  const { user } = useUser();
  const userId = user?.id;

  const { setLoading, setError } = useRideStore();
  const { isReady, setisReady, tripStatus, setTripStatus } = useDriverStatus();
  const bottomSheetRef = useRef<BottomSheet>(null);
  // Handle driver online status
  const handleGoOnline = () => {
    if (!userId) return;
    setLoading(true);
    try {
      const status = isReady ? "offline" : "ready";
      updateDriverStatus(status);
      setisReady(!isReady);
      setTripStatus(isReady ? "ready" : "offline");
      console.log(tripStatus, isReady);
      refetch;
    } catch (error) {
      console.error("Error updating driver status:", error);
      setError("Server error, please contact admin");
    } finally {
      setLoading(false);
    }
  };

  async function updateDriverStatus(status: string) {
    try {
      await fetchAPI(`/(api)/driver/status/${user?.id}`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ status }),
      });
      console.log("Driver status updated to DB as", status, user?.id);
    } catch (error) {
      console.error("Error updating driver status:", error);
      setError("Server error, please contact admin");
    } finally {
      setLoading(false);
    }
  }

  const {
    data: recentRides,
    loading,
    error,

    refetch,
  } = useFetch<Ride[]>(`/(api)/driver/ride/rides?id=${userId}`);

  // useEffect(() => {
  //   if (tripStatus === "offline") {
  //     updateDriverStatus("offline");
  //   }
  // }, [tripStatus]);

  return (
    <GestureHandlerRootView className="flex-1">
      <View className="flex-1 bg-white">
        <View className="flex flex-col h-screen bg-blue-500">
          {/* <View className="flex flex-row absolute z-10 top-16 items-center justify-start px-5">
          
            <TouchableOpacity onPress={onPress}>
              <View className="w-10 h-10 bg-white rounded-full items-center justify-center">
                <Image
                  source={icons.backArrow}
                  resizeMode="contain"
                  className="w-6 h-6"
                />
              </View>
            </TouchableOpacity>
           
            <Text className="text-xl font-JakartaSemiBold ml-5">
              {title || "Go Back"}
            </Text>
          </View> */}

          <DriverMap />
        </View>

        <BottomSheet
          ref={bottomSheetRef}
          snapPoints={snapPoints || ["40%", "85%"]} // init 40 n full 85
          index={0}
        >
          {title === "Choose a Rider" ? (
            <BottomSheetView
              style={{
                flex: 1,
                padding: 20,
              }}
            >
              {children}
            </BottomSheetView>
          ) : (
            <BottomSheetView
              style={{
                flex: 1,
                padding: 20,
              }}
            >
              {children}
            </BottomSheetView>
          )}
        </BottomSheet>
      </View>
    </GestureHandlerRootView>
  );
};

export default DriverLayout;
