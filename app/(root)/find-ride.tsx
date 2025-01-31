import { router } from "expo-router";
import { ActivityIndicator, Text, View } from "react-native";

import CustomButton from "@/components/CustomButton";
import GoogleTextInput from "@/components/GoogleTextInput";
import RideLayout from "@/components/RideLayout";
import { icons } from "@/constants";
import { useLocationStore } from "@/store";
import { useFetch } from "@/lib/fetch";
import { Driver } from "@/types/type";

const FindRide = () => {
  const {
    userAddress,
    destinationAddress,
    setDestinationLocation,
    setUserLocation,
  } = useLocationStore();

  const {
    data: drivers,
    loading,
    error,
    refetch,
  } = useFetch<Driver[]>("/(api)/driver");

  // start spinning circle
  if (loading)
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
  return (
    <RideLayout
      title="Ride"
      onPress={() => {
        refetch;
        router.push("/(root)/(tabs)/home");
      }}
    >
      <View className="my-3">
        <Text className="text-lg font-JakartaSemiBold mb-3">From</Text>

        <GoogleTextInput
          icon={icons.target}
          initialLocation={userAddress!}
          containerStyle="bg-neutral-100"
          textInputBackgroundColor="#f5f5f5"
          handlePress={(location) => setUserLocation(location)}
        />
      </View>

      <View className="my-3">
        <Text className="text-lg font-JakartaSemiBold mb-3">To</Text>

        <GoogleTextInput
          icon={icons.map}
          initialLocation={destinationAddress!}
          containerStyle="bg-neutral-100"
          textInputBackgroundColor="transparent"
          handlePress={(location) => setDestinationLocation(location)}
        />
      </View>
      {!drivers?.length! && (
        <View className="my-3">
          <Text className="text-lg font-JakartaSemiBold mb-3">
            No drivers at this moment retry in a few
          </Text>
        </View>
      )}

      {drivers?.length! > 0 && (
        <CustomButton
          title="Find Now"
          onPress={() => router.push(`/(root)/confirm-ride`)}
          className="mt-5"
        />
      )}
    </RideLayout>
  );
};

export default FindRide;
