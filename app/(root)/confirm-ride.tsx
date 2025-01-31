import { router } from "expo-router";
import { FlatList, Text, View } from "react-native";
import { useDriverStore } from "@/store";
import { useContext, useEffect, useState } from "react";
import SocketContext from "@/contexts/SocketContext";

import { fetchAPI } from "@/lib/fetch";
import RideLayout from "@/components/RideLayout";
import DriverCard from "@/components/DriverCard";
import CustomButton from "@/components/CustomButton";
import { updateDriverStatus } from "@/lib/utils";
import { useUser } from "@clerk/clerk-expo";
import EVENTS from "@/config/events";

const ConfirmRide = () => {
  const { user } = useUser();
  const {
    drivers,
    selectedDriver,
    setSelectedDriver,
    setDrivers,
    removeDriverById,
  } = useDriverStore();

  // async function updateDriverStatus(status: string) {
  //   try {
  //     const response = await fetchAPI(
  //       `/(api)/driver/status/id/${selectedDriver}`,
  //       {
  //         method: "POST",
  //         headers: {
  //           "Content-Type": "application/json",
  //         },
  //         body: JSON.stringify({
  //           status: status,
  //         }),
  //       }
  //     );

  //     console.log(
  //       `Driver status updated to ${status} for driver`,
  //       selectedDriver
  //     );
  //     // //EVENTS.CLIENT.ORDER_RIDE
  //   } catch (error) {
  //     console.error("Error updating driver status:", error);
  //   }
  // }

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
    return status === "ready";
  };
  const { socket, uid, users } = useContext(SocketContext).SocketState;

  // Function to emit event with object to socket server
  const sendMessage = (event: string, payload?: Object) => {
    socket?.emit(event, { payload, uid, users });
  };
  async function notifyRider() {
    console.log(`Letting driver with id ${selectedDriver} to be aware`);
    sendMessage(EVENTS.CLIENT.PRIVATE_MESSAGE, {
      status: "taken",
      driverId: selectedDriver,
      user: user?.id,
    });
  }
  const handleSelectDriver = async () => {
    const isfree = await isDriverFree(selectedDriver!);

    console.log(isfree);
    if (isfree) {
      console.log("Driver is free. Proceeding to book ride.");
      if (selectedDriver) {
        await updateDriverStatus(selectedDriver, "taken");
        await notifyRider();
      }

      router.push("/(root)/book-ride");
    } else {
      router.push("/(root)/find-ride");
      alert(
        "Driver is busy or taken. Please select an other driver or comeback in few mn"
      );
    }
  };

  // Set up WebSocket connection and event listeners
  useEffect(() => {
    if (socket) {
      socket.on(EVENTS.SERVER.UPDATE_DRIVERS, (payload) => {
        // Extracting driverId from the JSON object
        const data = payload;
        const driverId = data.payload.driverId;
        console.log("updateDrivers, driver in duty with id", driverId);

        // removeDriverById(driverId);
        // refetchDrivers();
        if (drivers?.length === 0) {
          router.push("/(root)/home");
          // Navigate to the desired page if drivers array is empty
          alert("No drivers at this moment");
        }
      });

      // const room = String(selectedDriver) + 99;
      // socket.on(room, () => {
      //   console.log("resp from room: ", room);
      // });
    }
    return () => {
      if (socket) {
        socket.off(EVENTS.SERVER.UPDATE_DRIVERS, () => {});
      }
    };
  }, [socket, removeDriverById, setDrivers, drivers]);

  return (
    <RideLayout
      title={"Choose a Driver"}
      snapPoints={["65%", "85%"]}
      onPress={() => router.push("/(root)/find-ride")}
    >
      {drivers.length > 0 && (
        <FlatList
          data={drivers}
          keyExtractor={(item, index) => index.toString()}
          renderItem={({ item, index }) => (
            <DriverCard
              item={item}
              selected={selectedDriver!}
              setSelected={async () => setSelectedDriver(item.id)}
              // setSelected={() => setSelectedDriver(Number(item.id))}
              // setSelected={async () => {
              //   const ok = await isDriverFree(selectedDriver!);
              //   if (!ok) {
              //     console.log("clearSelectedDriver");
              //     setSelectedDriver(0);
              //   } else {
              //     setSelectedDriver(item.id);
              //   }
              // }}
            />
          )}
          ListFooterComponent={() => (
            <View className="mx-5 mt-10">
              <CustomButton
                disabled={selectedDriver ? false : true}
                title="Select a Driver"
                onPress={() => {
                  handleSelectDriver();
                }}
              />
            </View>
          )}
        />
      )}
      {drivers.length === 0 && (
        <View>
          <Text>No drivers</Text>
        </View>
      )}
    </RideLayout>
  );
};

export default ConfirmRide;

// const drivers = [
//   {
//     id: "1",
//     first_name: "James",
//     last_name: "Wilson",
//     profile_image_url:
//       "https://ucarecdn.com/dae59f69-2c1f-48c3-a883-017bcf0f9950/-/preview/1000x666/",
//     car_image_url:
//       "https://ucarecdn.com/a2dc52b2-8bf7-4e49-9a36-3ffb5229ed02/-/preview/465x466/",
//     car_seats: 4,
//     rating: "4.80",
//   },
//   {
//     id: "2",
//     first_name: "David",
//     last_name: "Brown",
//     profile_image_url:
//       "https://ucarecdn.com/6ea6d83d-ef1a-483f-9106-837a3a5b3f67/-/preview/1000x666/",
//     car_image_url:
//       "https://ucarecdn.com/a3872f80-c094-409c-82f8-c9ff38429327/-/preview/930x932/",
//     car_seats: 5,
//     rating: "4.60",
//   },
//   {
//     id: "3",
//     first_name: "Michael",
//     last_name: "Johnson",
//     profile_image_url:
//       "https://ucarecdn.com/0330d85c-232e-4c30-bd04-e5e4d0e3d688/-/preview/826x822/",
//     car_image_url:
//       "https://ucarecdn.com/289764fb-55b6-4427-b1d1-f655987b4a14/-/preview/930x932/",
//     car_seats: 4,
//     rating: "4.70",
//   },
//   {
//     id: "4",
//     first_name: "Robert",
//     last_name: "Green",
//     profile_image_url:
//       "https://ucarecdn.com/fdfc54df-9d24-40f7-b7d3-6f391561c0db/-/preview/626x417/",
//     car_image_url:
//       "https://ucarecdn.com/b6fb3b55-7676-4ff3-8484-fb115e268d32/-/preview/930x932/",
//     car_seats: 4,
//     rating: "4.90",
//   },
// ];
