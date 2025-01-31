import CustomButton from "@/components/CustomButton";
import DriverLayout from "@/components/driver/DriverLayout";
import SocketContext from "@/contexts/SocketContext";
import { destinationOpenGoogleMapsNavigation } from "@/lib/driver";
import {
  updateDriverStatus,
  getRideStatus,
  updateRideStatus,
} from "@/lib/utils";
import { useDriverStatus } from "@/store";
import { useDriverLocationStore, useRideStore } from "@/store/driver";
import { useUser } from "@clerk/clerk-expo";
import { router } from "expo-router";
import React, { useContext, useState } from "react";
import { Text, View } from "react-native";

function InRoute() {
  const { user } = useUser();
  const userId = user?.id;
  const useRideStorage = useRideStore();
  const {
    ride,
    setRide,
    setLoading,
    setError,
    loading,
    error,
    rideStatus,
    setRideStatus,
  } = useRideStorage;
  const { driverLatitude, driverLongitude } = useDriverLocationStore();
  const { tripStatus, setTripStatus } = useDriverStatus();
  const { socket, uid, users } = useContext(SocketContext).SocketState;

  // const handleDriverStatus = (status: string) => {
  //   if (!userId) return;
  //   setLoading(true);
  //   try {
  //     if (tripStatus === "ready" || tripStatus === "onDuty") {
  //       setTripStatus(status);
  //       updateDriverStatus(userId, status);

  //       console.log("tripStatus", tripStatus);
  //       router.replace("/(root)/home");
  //     } else {
  //       alert("complete trip activities first");
  //     }

  //     setLoading(false);
  //   } catch (error) {
  //     console.error("Error updating driver status:", error);
  //     setError("Server error, please contact admin");
  //   } finally {
  //     setLoading(false);
  //   }
  // };
  const HandleUpUpdateButton = (status: string) => {
    //update driver
    // handleDriverStatus(status);
    // getRideStatus(ride?.ride_id!);
    // setTripStatus(status);
    // setRide();
    //update ride
    updateRideStatus(ride?.ride_id!, status);
  };
  // Function to emit event with object to socket server
  const sendMessage = (event: string, payload?: Object) => {
    socket?.emit(event, { payload, uid, users });
  };

  return (
    <DriverLayout
      title={"Waiting screen"}
      snapPoints={["40%", "85%"]}
      onPress={() => {
        router.back();
      }}
    >
      <View className="flex flex-col gap-2">
        {ride?.origin_address && (
          <View>
            <Text>
              {rideStatus === "toOrigin"
                ? "Going to pick up rider @"
                : "Dropping rider @"}
            </Text>
            {ride?.origin_address ? (
              <Text className="text-xl font-JakartaBold mt-5 mb-3">
                {rideStatus === "toOrigin"
                  ? ride?.origin_address
                  : ride?.destination_address}
              </Text>
            ) : (
              <>No rides</>
            )}
          </View>
        )}
        <View className="flex flex-col gap-4">
          {ride?.origin_address ? (
            <>
              {rideStatus === "toDestination" && (
                <>
                  <CustomButton
                    title="Navigate to Destination"
                    onPress={() => {
                      destinationOpenGoogleMapsNavigation(
                        ride?.origin_latitude!,
                        ride?.origin_longitude!,
                        ride?.destination_latitude!,
                        ride?.destination_longitude!
                      );
                    }}
                    className="bg-green-500 mb-5"
                  />
                  <CustomButton
                    title="Complete Ride"
                    onPress={() => {
                      HandleUpUpdateButton("completed");
                      setRideStatus("completed");
                      setTripStatus("ready");
                      updateDriverStatus(userId!, "ready");
                      //  setRideDest({
                      //    latitude: ride?.origin_latitude!,
                      //    longitude: ride?.origin_longitude!,
                      //  });
                    }}
                    className={`${tripStatus === "toOrigin" ? "bg-green-500" : "bg-gray-500"}`}
                  />
                </>
              )}

              {rideStatus === "toOrigin" && (
                <>
                  <CustomButton
                    title="Navigate to Origin"
                    onPress={() => {
                      destinationOpenGoogleMapsNavigation(
                        driverLatitude!,
                        driverLongitude!,
                        ride?.origin_latitude!,
                        ride?.origin_longitude!
                      );
                    }}
                    className="bg-blue-500 mb-5"
                  />

                  <CustomButton
                    title="Rider Picked"
                    onPress={() => {
                      HandleUpUpdateButton("toDestination");
                      setRideStatus("toDestination");
                      // setTripStatus(status);
                    }}
                    className={`${tripStatus === "toOrigin" ? "bg-green-500" : "bg-gray-500"}`}
                  />
                </>
              )}
            </>
          ) : (
            <>
              <Text className="text-center text-xl font-JakartaExtraLight pb-10">
                No rides at this moment
              </Text>
            </>
          )}
          {/* {!ride?.origin_address && (
            <View className="flex flex-row justify-between">
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
            </View>
          )} */}
        </View>
      </View>
    </DriverLayout>
  );
}

export default InRoute;
