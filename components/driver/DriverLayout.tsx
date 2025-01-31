import BottomSheet, {
  BottomSheetScrollView,
  BottomSheetView,
} from "@gorhom/bottom-sheet";
import { router } from "expo-router";
import React, { useEffect, useRef, useState } from "react";
import { Image, Text, TouchableOpacity, View } from "react-native";
import { GestureHandlerRootView } from "react-native-gesture-handler";

import DriverMap from "@/components/driver/DriverMap";
import { icons } from "@/constants";
import { useUser } from "@clerk/clerk-expo";
import { useRideStore } from "@/store/driver";
import { fetchAPI } from "@/lib/fetch";
import { useDriverStatus } from "@/store";

const DriverLayout = ({
  title,
  snapPoints,
  children,
}: {
  title: string;
  snapPoints?: string[];
  children: React.ReactNode;
}) => {
  const bottomSheetRef = useRef<BottomSheet>(null);
  const { user } = useUser();
  const userId = user?.id;
  const { ride, setLoading, setError } = useRideStore();
  const { isReady, setisReady } = useDriverStatus();
  //handleGoOnline
  const handleGoOnline = () => {
    if (!userId) return;
    setLoading(true);
    try {
      if (isReady) {
        updateDriverStatus("offline");
        setisReady(false);
      } else {
        updateDriverStatus("ready");
        setisReady(true);
      }
    } catch (error) {
      console.error("Error updating driver status:", error);
      setError("Server error, please contact admin");
    } finally {
      setLoading(false);
    }
  };

  async function updateDriverStatus(status: string) {
    setLoading(true);
    try {
      const response = await fetchAPI(`/(api)/driver/status/${user?.id}`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          status: status,
        }),
      });
      // Handle the response if needed
      console.log("Driver status updated to DB as", status, user?.id);
      setLoading(false);

      // console.log(status, "mode");
    } catch (error) {
      console.error("Error updating driver status:", error);
      setError("Server error, please contact admin");
    } finally {
      setLoading(false);
    }
  }

  useEffect(() => {
    (async () => {
      updateDriverStatus("offline");
      setisReady(false);
    })();
  }, []);

  return (
    <GestureHandlerRootView className="flex-1">
      <View className="flex-1 bg-white">
        <View className="flex flex-col h-1/2 bg-blue-500">
          {isReady === false ? (
            <View className="flex flex-row absolute left-[30%] z-10 top-[70%] items-center justify-start ">
              {/* back botton */}
              <TouchableOpacity
                onPress={() => {
                  handleGoOnline();
                  // updateDriverStatus(String(user?.id), "offline");
                }}
                className="flex flex-row items-center justify-start"
              >
                <View>
                  {/* title */}
                  <Text className="text-white text-2xl font-JakartaExtraBold mr-2">
                    {"Go Online"}
                  </Text>
                </View>
                <View className="w-10 h-10 bg-green-500 rounded-full items-center justify-center">
                  <Image
                    source={icons.arrowUp}
                    resizeMode="contain"
                    className="w-6 h-6 rotate-90"
                  />
                </View>
              </TouchableOpacity>
            </View>
          ) : (
            <View className="flex flex-col absolute left-[30%] z-10 top-[70%] items-center justify-start ">
              {/* back botton */}
              <TouchableOpacity
                onPress={() => {
                  handleGoOnline();
                }}
                className="flex flex-row items-center justify-start"
              >
                <View className="w-10 h-10 bg-orange-200 rounded-full items-center justify-center">
                  <Image
                    source={icons.arrowUp}
                    resizeMode="contain"
                    className="w-6 h-6 -rotate-90"
                  />
                </View>
                <View>
                  {/* title */}
                  <Text className="text-2xl font-JakartaBold ml-2">
                    {"Go Offline"}
                  </Text>
                </View>
              </TouchableOpacity>
              <Text className="text-sm bg-white text-orange-600 px-5 rounded-full">
                Now Taking trips
              </Text>
            </View>
          )}
          {isReady === true && <DriverMap />}
        </View>

        {isReady === true ? (
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
                {title !== "Home" && (
                  <View className="flex flex-col mb-10">
                    {/* back botton */}

                    <TouchableOpacity
                      onPress={() => router.push("/(driver)/(tabs)/home")}
                      className="flex flex-row absolute z-10 top-0 items-center justify-end"
                    >
                      <>
                        <View className="w-10 h-10  bg-white rounded-full items-center justify-center">
                          <Image
                            source={icons.backArrow}
                            resizeMode="contain"
                            className="w-6 h-6"
                          />
                        </View>
                        {/* title */}
                        <Text className="text-xl font-JakartaSemiBold ">
                          {title}
                        </Text>
                      </>
                    </TouchableOpacity>
                  </View>
                )}

                {children}
              </BottomSheetView>
            )}
          </BottomSheet>
        ) : (
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
                {title !== "Home" && (
                  <View className="flex flex-col mb-10">
                    {/* back botton */}

                    <TouchableOpacity
                      onPress={() => router.push("/(driver)/(tabs)/home")}
                      className="flex flex-row absolute z-10 top-0 items-center justify-end"
                    >
                      <>
                        <View className="w-10 h-10  bg-white rounded-full items-center justify-center">
                          <Image
                            source={icons.backArrow}
                            resizeMode="contain"
                            className="w-6 h-6"
                          />
                        </View>
                        {/* title */}
                        <Text className="text-xl font-JakartaSemiBold ">
                          {title}
                        </Text>
                      </>
                    </TouchableOpacity>
                  </View>
                )}

                <View>
                  <Text className="text-xl font-JakartaMedium">
                    Go online to receive orders
                  </Text>
                  <Text>Recent rides</Text>
                  {/* <TouchableOpacity
                    onPress={() => {
                      updateDriverStatus(String(user?.id), "offline");
                    }}
                  >
                    <Text>Go</Text>
                  </TouchableOpacity> */}
                </View>
              </BottomSheetView>
            )}
          </BottomSheet>
        )}
      </View>
    </GestureHandlerRootView>
  );
};

export default DriverLayout;
