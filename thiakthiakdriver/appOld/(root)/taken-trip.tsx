import CustomButton from "@/components/CustomButton";
import DriverLayout from "@/components/driver/DriverLayout";
import { updateDriverStatus } from "@/lib/utils";
import { useDriverStatus } from "@/store";
import { useDriverLocationStore, useRideStore } from "@/store/driver";
import { useUser } from "@clerk/clerk-expo";
import { router } from "expo-router";
import React from "react";
import { Button, Text, View } from "react-native";

function Complete() {
  const useRideStorage = useRideStore();
  const { ride, setRide, setLoading, setError, loading, error } =
    useRideStorage;
  const { driverLatitude, driverLongitude } = useDriverLocationStore();
  const { user } = useUser();
  const userId = user?.id;
  const { tripStatus, setTripStatus } = useDriverStatus();

  //socket
  // useEffect(() => {
  //   if (socket) {
  //     socket.on("3" + "order", (payload) => {
  //       try {
  //         console.log("received something", payload);
  //         const { driverId, status, user, rideInfo } = payload;
  //         if (status) {
  //           setTripStatus(status);
  //           console.log("Driver TripStatus set to:", payload); // Log the new status
  //         } else {
  //           console.warn("Status not found in payload:", payload); // Log if status is not found
  //         }
  //       } catch (error) {
  //         console.error("Error handling socket payload:", error);
  //       }
  //     });

  //     socket.on("error", (error) => {
  //       console.error("Socket error:", error);
  //     });
  //   }
  //   return () => {
  //     if (socket) {
  //       socket.off("399", () => {});
  //     }
  //   };
  // }, [socket, setTripStatus]);

  return (
    <DriverLayout
      title={"Waiting screen"}
      snapPoints={["40%", "85%"]}
      onPress={() => {
        router.back();
      }}
    >
      <View className="flex flex-col gap-4">
        <View>
          <Text>
            U have been selected by a rider, within few mn u can change back ur
            status if next screen doesnt apeared
          </Text>
        </View>
        <View>
          <CustomButton
            title="Back to Ready"
            onPress={() => {
              updateDriverStatus(userId!, "ready");
              setTripStatus("ready");
            }}
            className="bg-blue-500"
          />
          <CustomButton
            title="BG scren"
            onPress={() => {
              router.push("/(root)/todestination-trip");
            }}
            className="bg-blue-500"
          />
        </View>
        {/* <Button
          title="Go to QR Code Scanner"
          onPress={() => router.push("/qrcode-scanner")}
        /> */}
        {/* <Button
          title="Go to QR Code Generator"
          onPress={() => router.push("/qrcode-generator")}
        /> */}

        {/* <Button
          title="Go to BarCode Scanner"
          onPress={() => router.push("/barcode-scanner")}
        /> */}

        {/* <Button
          title="Go to BarCode Generator"
          onPress={() => router.push("/barcode-generator")}
        /> */}
      </View>
    </DriverLayout>
  );
}

export default Complete;
