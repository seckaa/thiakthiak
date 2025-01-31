import React, { useContext, useEffect, useState } from "react";
import { ActivityIndicator, Text, View } from "react-native";
import MapView, {
  Marker,
  PROVIDER_DEFAULT,
  PROVIDER_GOOGLE,
} from "react-native-maps";
import MapViewDirections from "react-native-maps-directions";

import { icons } from "@/constants";
import { fetchAPI, useFetch } from "@/lib/fetch";
import {
  calculateDriverTimes,
  calculateRegion,
  generateMarkersFromData,
} from "@/lib/map";
import { useDriverStore, useLocationStore } from "@/store";
import { Driver, MarkerData } from "@/types/type";
import SocketContext from "@/contexts/SocketContext";
import EVENTS from "@/config/events";
const directionsAPI = process.env.EXPO_PUBLIC_GOOGLE_API_KEY;

const Map = () => {
  const {
    userLongitude,
    userLatitude,
    destinationLatitude,
    destinationLongitude,
  } = useLocationStore();
  const { selectedDriver, setDrivers, removeDriverById, clearDrivers } =
    useDriverStore();
  const [markers, setMarkers] = useState<MarkerData[]>([]);
  const {
    data: drivers,
    loading,
    error,
    refetch,
  } = useFetch<Driver[]>("/(api)/driver");
  const { socket } = useContext(SocketContext).SocketState;

  // Refetch drivers periodically and on socket event
  const refetchDrivers = async () => {
    clearDrivers();
    await refetch();
    if (!loading && !error && drivers) {
      setDrivers(drivers as MarkerData[]);
    }
  };
  useEffect(() => {
    // (async () => {})();
    const handleUpdateDrivers = async (payload: any) => {
      const driverId = payload.driverId;
      removeDriverById(driverId);
      await refetchDrivers();
    };
    socket?.on(EVENTS.SERVER.UPDATE_DRIVERS, handleUpdateDrivers);
    const interval = setInterval(refetchDrivers, 300000); // Refetch every 300 seconds
    return () => {
      clearInterval(interval);
      socket?.off(EVENTS.SERVER.UPDATE_DRIVERS, handleUpdateDrivers);
    };
  }, [socket, refetchDrivers]);

  //setMarkers
  useEffect(() => {
    if (Array.isArray(drivers)) {
      if (!userLatitude || !userLongitude) return;

      const newMarkers = generateMarkersFromData({
        data: drivers,
        userLatitude,
        userLongitude,
      });
      // console.log(newMarkers);
      setMarkers(newMarkers);
    }
  }, [drivers, userLatitude, userLongitude]);

  // add to ...marker, time: totalTime, price time
  useEffect(() => {
    if (
      markers.length > 0 &&
      destinationLatitude !== undefined &&
      destinationLongitude !== undefined
    ) {
      calculateDriverTimes({
        markers,
        userLatitude,
        userLongitude,
        destinationLatitude,
        destinationLongitude,
      }).then((drivers) => {
        setDrivers(drivers as MarkerData[]);
      });
    }
  }, [markers, destinationLatitude, destinationLongitude]);

  const region = calculateRegion({
    userLatitude,
    userLongitude,
    destinationLatitude,
    destinationLongitude,
  });

  // start spinning circle
  if (loading || (!userLatitude && !userLongitude))
    return (
      <View className="flex justify-between items-center w-full">
        <ActivityIndicator size="small" color="#000" />
      </View>
    );

  if (error)
    return (
      <View className="flex justify-between items-center w-full">
        <Text>Error: {error}</Text>
      </View>
    );
  // end  spinning circle

  // map
  return (
    <MapView
      // provider={PROVIDER_DEFAULT}
      provider={PROVIDER_GOOGLE}
      className="w-full h-full rounded-2xl"
      tintColor="black"
      // mapType="mutedStandard"
      // mapType={"mutedStandard"}
      mapType="standard"
      showsPointsOfInterest={false}
      initialRegion={region}
      showsUserLocation={true}
      userInterfaceStyle="light"
    >
      {/* near by cars */}
      {/* {mockdriver.map((marker, index) => ( */}
      {markers.map((marker, index) => (
        <Marker
          key={marker.id}
          coordinate={{
            // latitude: marker.latitude,// before
            // longitude: marker.longitude,// before
            latitude: Number(marker.latitude),
            longitude: Number(marker.longitude),
          }}
          title={marker.title}
          image={
            selectedDriver === +marker.id ? icons.selectedMarker : icons.marker
          }
        />
      ))}

      {destinationLatitude && destinationLongitude && (
        <>
          <Marker
            key="destination"
            coordinate={{
              latitude: destinationLatitude,
              longitude: destinationLongitude,
            }}
            title="Destination"
            image={icons.pin}
          />
          <MapViewDirections
            origin={{
              latitude: userLatitude!,
              longitude: userLongitude!,
            }}
            destination={{
              latitude: destinationLatitude,
              longitude: destinationLongitude,
            }}
            // apikey={process.env.EXPO_PUBLIC_GOOGLE_API_KEY!}
            apikey={directionsAPI!}
            strokeColor="#0286FF"
            strokeWidth={3}
            onError={(errorMessage) =>
              console.log("MapViewDirections Error:", errorMessage)
            }
          />
        </>
      )}
    </MapView>
  );
};

export default Map;

// import haversine from "haversine-distance";// not in use for distance

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

// const directionsAPI = process.env.EXPO_PUBLIC_DIRECTIONS_API_KEY;

// const mockdriver = [
//   {
//     car_image_url:
//       "https://ucarecdn.com/a2dc52b2-8bf7-4e49-9a36-3ffb5229ed02/-/preview/465x466/",
//     car_seats: 4,
//     first_name: "James",
//     id: 1,
//     last_name: "Wilson",
//     latitude: 40.9058815534422,
//     longitude: -73.85217080600349,
//     profile_image_url:
//       "https://ucarecdn.com/dae59f69-2c1f-48c3-a883-017bcf0f9950/-/preview/1000x666/",
//     rating: "4.80",
//     title: "James Wilson",
//   },
//   {
//     car_image_url:
//       "https://ucarecdn.com/a3872f80-c094-409c-82f8-c9ff38429327/-/preview/930x932/",
//     car_seats: 5,
//     first_name: "David",
//     id: 2,
//     last_name: "Brown",
//     // latitude: 40.90661072208386,
//     // longitude: -73.85468002069072,
//     latitude: 40.9041198,
//     longitude: -73.8512999,
//     profile_image_url:
//       "https://ucarecdn.com/6ea6d83d-ef1a-483f-9106-837a3a5b3f67/-/preview/1000x666/",
//     rating: "4.60",
//     title: "David Brown",
//   },
//   {
//     car_image_url:
//       "https://ucarecdn.com/289764fb-55b6-4427-b1d1-f655987b4a14/-/preview/930x932/",
//     car_seats: 4,
//     first_name: "Michael",
//     id: 3,
//     last_name: "Johnson",
//     // latitude: 40.905433022717055,
//     // longitude: -73.85290842282393,
//     latitude: 40.8878068,
//     longitude: -73.86118669999999,
//     profile_image_url:
//       "https://ucarecdn.com/0330d85c-232e-4c30-bd04-e5e4d0e3d688/-/preview/826x822/",
//     rating: "4.70",
//     title: "Michael Johnson",
//   },
//   {
//     car_image_url:
//       "https://ucarecdn.com/b6fb3b55-7676-4ff3-8484-fb115e268d32/-/preview/930x932/",
//     car_seats: 4,
//     first_name: "Robert",
//     id: 4,
//     last_name: "Green",
//     latitude: 40.90352150599902,
//     longitude: -73.8524670176405,
//     profile_image_url:
//       "https://ucarecdn.com/fdfc54df-9d24-40f7-b7d3-6f391561c0db/-/preview/626x417/",
//     rating: "3.90",
//     title: "Robert Green",
//   },
// ];
