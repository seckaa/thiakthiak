import CustomButton from "@/components/CustomButton";
import DriverLayout from "@/components/driver/DriverLayout";
import SocketContext from "@/contexts/SocketContext";
import { destinationOpenGoogleMapsNavigation } from "@/lib/driver";
import { updateDriverStatus, updateRideStatus } from "@/lib/utils";
import { useDriverStatus } from "@/store";
import { useDriverLocationStore, useRideStore } from "@/store/driver";
import { useUser } from "@clerk/clerk-expo";
import { router } from "expo-router";
import React, { useContext, useRef } from "react";
import { Text, View } from "react-native";

function InRoute() {
  const { user } = useUser();
  const userId = user?.id;
  const useRideStorage = useRideStore();
  const { ride, setRide, setLoading, setError, loading, error } =
    useRideStorage;
  const { driverLatitude, driverLongitude } = useDriverLocationStore();
  const { tripStatus, setTripStatus } = useDriverStatus();
  const { socket, uid, users } = useContext(SocketContext).SocketState;
  const hasRedirected = useRef(false); // Create a ref to track redirection
  const hasScheduled = useRef(false);

  const handlePausedOrOfflineStatus = (status: string) => {
    if (!userId) return;
    setLoading(true);
    try {
      if (tripStatus === "ready" || tripStatus === "onDuty") {
        setTripStatus(status);
        updateDriverStatus(userId, status);

        console.log("tripStatus", tripStatus);
        router.replace("/(root)/home");
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
  const HandleUpUpdateButton = (status: string) => {
    //update driver
    handlePausedOrOfflineStatus(status);
    updateRideStatus(ride?.ride_id!);
    setTripStatus(status);
    // setRide();
    //update ride
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
      <View>
        {ride?.origin_address && (
          <View>
            <Text>Destination</Text>
            {ride?.origin_address ? (
              <Text className="text-xl font-JakartaBold mt-5 mb-3">
                {ride?.origin_address}
              </Text>
            ) : (
              <>No rides</>
            )}
          </View>
        )}
        <View className="flex flex-col gap-4">
          {ride?.origin_address ? (
            <>
              <CustomButton
                title="Navigate to User"
                onPress={() => {
                  destinationOpenGoogleMapsNavigation(
                    driverLatitude!,
                    driverLongitude!,
                    ride?.origin_latitude!,
                    ride?.origin_longitude!
                  );
                }}
                className="bg-blue-500"
              />
              <CustomButton
                disabled={tripStatus === "atOrigin"}
                title="Mark trip as picked"
                onPress={() => {
                  HandleUpUpdateButton("atOrigin");
                }}
                className={`${tripStatus === "atDestination" ? "bg-green-500" : "bg-gray-500"}`}
              />
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
