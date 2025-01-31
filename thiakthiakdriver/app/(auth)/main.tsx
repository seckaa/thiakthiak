import { icons } from "@/constants";
import { useAuth, useUser } from "@clerk/clerk-expo";
import { router } from "expo-router";
import { Image, Text, TouchableOpacity, View } from "react-native";
import { SafeAreaView } from "react-native-safe-area-context";

function Main() {
  const { user } = useUser();
  const { signOut } = useAuth();
  // console.log(user);
  const handleSignOut = () => {
    signOut();
    router.replace("/(auth)/sign-in");
  };
  return (
    <SafeAreaView className="flex h-full items-center justify-between bg-white">
      <View className="flex flex-row justify-center items-center h-[50%]">
        <TouchableOpacity
          onPress={handleSignOut}
          className="justify-center items-center w-10 h-10 rounded-full bg-white"
        >
          <Image source={icons.out} className="w-4 h-4" />
        </TouchableOpacity>
        <Text>See admin to change ur profile</Text>
      </View>
    </SafeAreaView>
  );
}

export default Main;
