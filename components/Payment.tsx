import { useAuth } from "@clerk/clerk-expo";
import { useStripe } from "@stripe/stripe-react-native";
import { router } from "expo-router";
import React, { useContext, useState } from "react";
import { Alert, Image, Text, View } from "react-native";
import { ReactNativeModal } from "react-native-modal";

import CustomButton from "@/components/CustomButton";
import { images } from "@/constants";
import { fetchAPI } from "@/lib/fetch";
import { useDriverStore, useLocationStore } from "@/store";
import { PaymentProps } from "@/types/type";
import EVENTS from "@/config/events";
import { Float } from "react-native/Libraries/Types/CodegenTypes";
import SocketContext from "@/contexts/SocketContext";

const Payment = ({
  fullName,
  email,
  amount,
  driverId,
  rideTime,
  isCash,
}: PaymentProps) => {
  //type of PaymentProps
  const { initPaymentSheet, presentPaymentSheet } = useStripe();

  const {
    userAddress,
    userLongitude,
    userLatitude,
    destinationLatitude,
    destinationAddress,
    destinationLongitude,
  } = useLocationStore();

  const [nextPage, setnextPage] = useState(true);

  const { userId } = useAuth();
  const [success, setSuccess] = useState<boolean>(false);
  const { selectedDriver, clearSelectedDriver } = useDriverStore();

  // const confirmHandler = async (
  //   paymentMethod,
  //   shouldSavePaymentMethod,
  //   intendCreationCallBack
  // ) => {
  //   //explain later
  // };

  // const fetchPublishableKey = async () => {
  //   // const key = await fetchKey(); // fetch key from ur server
  //   //setPublishableKey();
  // };

  // useEffect(() => {
  //   fetchPublishableKey;();
  // }, [])

  const { socket, uid, users } = useContext(SocketContext).SocketState;
  // Function to emit event with object to socket server
  const sendMessage = (event: string, payload?: Object) => {
    socket?.emit(event, { payload, uid, users });
  };
  const openPaymentSheet = async () => {
    await initializePaymentSheet();

    const { error } = await presentPaymentSheet();

    if (error) {
      Alert.alert(`Error code: ${error.code}`, error.message);
    } else {
      setSuccess(true);
      updateDriverStatus();
      clearSelectedDriver();
    }
  };

  const initializePaymentSheet = async () => {
    const { error } = await initPaymentSheet({
      merchantDisplayName: "Thiak Thiak, Inc.",
      intentConfiguration: {
        mode: {
          amount: parseInt(amount) * 100,
          currencyCode: "usd",
        },
        confirmHandler: async (
          paymentMethod,
          shouldSavePaymentMethod,
          // _, // for not use props
          intentCreationCallback
        ) => {
          const { paymentIntent, customer } = await fetchAPI(
            "/(api)/(stripe)/create",
            {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({
                name: fullName || email.split("@")[0],
                email: email,
                amount: amount,
                paymentMethodId: paymentMethod.id,
              }),
            }
          );

          if (paymentIntent.client_secret) {
            const { result } = await fetchAPI("/(api)/(stripe)/pay", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({
                payment_method_id: paymentMethod.id,
                payment_intent_id: paymentIntent.id,
                customer_id: customer,
                client_secret: paymentIntent.client_secret,
              }),
            });

            if (result.client_secret) {
              await fetchAPI("/(api)/ride/create", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                },
                body: JSON.stringify({
                  origin_address: userAddress,
                  destination_address: destinationAddress,
                  origin_latitude: userLatitude,
                  origin_longitude: userLongitude,
                  destination_latitude: destinationLatitude,
                  destination_longitude: destinationLongitude,
                  ride_time: rideTime.toFixed(0),
                  fare_price: parseInt(amount) * 100,
                  payment_status: "paid",
                  driver_id: driverId,
                  user_id: userId,
                }),
              });

              intentCreationCallback({
                clientSecret: result.client_secret,
              });
            }
          }
        },
      },
      returnURL: "myapp://book-ride", // like in app.json  "scheme": "myapp",
    });

    if (!error) {
      // setLoading(true);
    }
  };

  const cashPayment = async () => {
    const data = JSON.stringify({
      origin_address: userAddress,
      destination_address: destinationAddress,
      origin_latitude: userLatitude,
      origin_longitude: userLongitude,
      destination_latitude: destinationLatitude,
      destination_longitude: destinationLongitude,
      ride_time: rideTime.toFixed(0),
      fare_price: parseInt(amount) * 100,
      payment_status: "pending",
      driver_id: driverId,
      user_id: userId,
    });

    const isfree = await isDriverFree(selectedDriver!);
    if (isfree) {
      console.log("order can be placed", isfree);
      try {
        console.log("Cash Payment", data);

        await fetchAPI("/(api)/ride/create", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: data,
        });
        setSuccess(true);
        updateDriverStatus();
        clearSelectedDriver();

        // returnURL: "myapp://book-ride", // like in app.json  "scheme": "myapp",
      } catch (error) {
        setSuccess(false);
        console.log(error);
      }
      console.log("u can place an order");
    } else {
      router.push("/(root)/find-ride");

      alert("U took too long, Driver went back to ready");
    }
  };

  async function updateDriverStatus() {
    try {
      const response = await fetchAPI(
        `/(api)/driver/status/id/${selectedDriver}`,
        {
          method: "POST",

          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            status: "onDuty",
          }),
        }
      );

      sendMessage(EVENTS.CLIENT.ORDER_RIDE, {
        message: "orderRide",
        driverId: selectedDriver,
        userId: userId,
        status: "onDuty",
        rideInfo: {
          origin_address: userAddress,
          destination_address: destinationAddress,
          origin_latitude: userLatitude,
          origin_longitude: userLongitude,
          destination_latitude: destinationLatitude,
          destination_longitude: destinationLongitude,
          ride_time: rideTime.toFixed(0),
          fare_price: parseInt(amount) * 100,
          payment_status: "paid",
          driver_id: driverId,
          user_id: userId,
        },
      });
      console.log("onDuty mode for driver", selectedDriver);
      //EVENTS.CLIENT.ORDER_RIDE
    } catch (error) {
      console.error("Error updating driver status:", error);
    }
  }
  //is driver still taken status
  const checkDriverStatus = async (driverId: number) => {
    try {
      const response = await fetchAPI(
        `/(api)/driver/status/id/list/${driverId}`,
        {
          method: "GET",
          headers: { "Content-Type": "application/json" },
        }
      );

      if (response.data && response.data.length > 0) {
        // console.log("response", response);
        return response.data[0].status;
        // return response;
      } else {
        throw new Error("Invalid response structure");
      }
    } catch (error) {
      console.error("Error fetching driver status:", error);
      return null;
    }
  };

  const isDriverFree = async (driverId: number) => {
    const status = await checkDriverStatus(driverId);
    console.log("status", status);
    // return status !== "taken";
    return status === "taken";
  };
  //bank
  const completeTrip = async (
    // tripId: number,
    driverId: number,
    amount: Float
  ) => {
    try {
      const commissionRate = 0.62; // Assuming a 80% commission rate

      const commission = amount * commissionRate;

      // Update driver's bank account balance
      await fetch("/(api)/bank/driver/update-balance", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ driverId, tripCommission: commission }),
      });

      // Update user's bank account balance
      await fetch("/(api)/bank/user/update-balance", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          userId,

          tripAmount: amount,
        }),
      });

      console.log(
        `Commission of $${commission} added to driver ${driverId}'s account`
      );
    } catch (error) {
      console.error("Error completing trip:", error);
    }
  };

  // // Example call to completeTrip when a trip is finished
  // completeTrip(1, 42, 100); // Arguments: tripId, driverId, tripAmount

  return (
    <>
      {!isCash && (
        <CustomButton
          title="Digital Payment"
          className="my-5"
          onPress={async () => {
            const isfree = await isDriverFree(selectedDriver!);
            if (isfree) {
              console.log(isfree);
              console.log("u can place an order", isfree);
              openPaymentSheet();
            } else {
              router.push("/(root)/find-ride");
              alert("U took too long Driver went back to ready");
            }
          }}
        />
      )}

      {isCash && (
        <CustomButton
          title="Cash Payment"
          className="mt-5"
          onPress={() => {
            // console.log("Cash selected");
            cashPayment();
          }}
        />
      )}

      <ReactNativeModal
        isVisible={success}
        // onBackdropPress={() => setSuccess(false)}
      >
        <View className="flex flex-col items-center justify-center bg-white p-7 rounded-2xl">
          <Image source={images.check} className="w-28 h-28 mt-5" />

          <Text className="text-2xl text-center font-JakartaBold mt-5">
            Booking placed successfully
          </Text>

          <Text className="text-md text-general-200 font-JakartaRegular text-center mt-3">
            Thank you for your booking. Your reservation has been successfully
            placed. Please proceed with your trip.
          </Text>

          <CustomButton
            title="Back Home"
            onPress={() => {
              setSuccess(false);
              router.push("/(root)/(tabs)/home");
            }}
            className="mt-5"
          />
        </View>
      </ReactNativeModal>
    </>
  );
};

export default Payment;
