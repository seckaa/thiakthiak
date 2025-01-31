import React, { useEffect, useState } from "react";
import { ActivityIndicator, Alert, Button, Text, View } from "react-native";
import MapView, { Marker, PROVIDER_DEFAULT } from "react-native-maps";
import MapViewDirections from "react-native-maps-directions";

import { icons } from "@/constants";
import { useDriverLocationStore, useRideStore } from "@/store/driver";
import { calculateRegionDriver } from "@/lib/driver/mapdriver";
import { useUser } from "@clerk/clerk-expo";
import * as Location from "expo-location";
import { Ride } from "@/types/type";

const directionsAPI = process.env.EXPO_PUBLIC_GOOGLE_API_KEY;

const DriverMap = () => {
  const { user } = useUser();
  //driver data
  const {
    driverLongitude,
    driverLatitude,
    driverDestinationLatitude,
    driverDestinationLongitude,
  } = useDriverLocationStore();

  const useRideStorage = useRideStore();
  const { ride, loading, error } = useRideStorage;

  // const updateRide: Ride = ride?.map((item: Ride) => ({
  //   ...item,
  //   origin_latitude: Number(item.origin_latitude),
  //   origin_longitude: Number(item.origin_longitude),
  //   destination_latitude: Number(item.destination_latitude),
  //   destination_longitude: Number(item.destination_longitude),
  // }));

  // const rideData: number = ride?.destination_latitude;
  // console.log("useRideStore map ride : ", ride?.destination_address);

  const [hasPermission, setHasPermission] = useState<boolean>(false);

  // Calculate the region for the map
  const region = calculateRegionDriver({
    driverLatitude,
    driverLongitude,
    driverDestinationLatitude,
    driverDestinationLongitude,
  });

  // Display loading indicator if data is loading or driver location is not available
  if (loading || (!driverLongitude && !driverLongitude))
    return (
      <View className="flex justify-between items-center w-full">
        <ActivityIndicator size="small" color="#000" />
      </View>
    );

  // Display error message if there is an error
  if (error)
    return (
      <View className="flex justify-between items-center w-full">
        <Text>Error: {error}</Text>
      </View>
    );

  // console.log(
  //   driverLatitude,
  //   driverLongitude,
  //   driverDestinationLatitude,
  //   driverDestinationLongitude
  // );
  // Render the map with driver and destination markers
  return (
    <>
      <MapView
        provider={PROVIDER_DEFAULT}
        className="w-full h-full rounded-2xl"
        tintColor="black"
        mapType="standard"
        showsPointsOfInterest={false}
        initialRegion={region}
        showsUserLocation={true}
        userInterfaceStyle="light"
      >
        {/* driver marker */}
        <Marker
          key={user?.id}
          coordinate={{
            // latitude: marker.latitude,// before
            // longitude: marker.longitude,// before
            latitude: driverLatitude!,
            longitude: driverLongitude,
          }}
          title="Driver address"
          image={icons.marker}
        />

        {ride?.origin_latitude! && ride.origin_longitude! && (
          <>
            <Marker
              // key="destination"
              coordinate={{
                latitude: ride.origin_latitude,
                longitude: ride.origin_longitude,
              }}
              title="User Location"
              image={icons.pin}
            />
            <MapViewDirections
              origin={{
                latitude: driverLatitude!,
                longitude: driverLongitude,
              }}
              destination={{
                latitude: ride.origin_latitude,
                longitude: ride.origin_longitude,
              }}
              apikey={process.env.EXPO_PUBLIC_GOOGLE_API_KEY!}
              // apikey={directionsAPI!}
              strokeColor="#0286FF"
              strokeWidth={3}
            />
          </>
        )}
      </MapView>
    </>
  );
  // return (
  //   <>
  //     <Text>Test</Text>
  //   </>
  // );
};

export default DriverMap;
