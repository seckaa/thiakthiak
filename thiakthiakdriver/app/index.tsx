import { useAuth, useUser } from "@clerk/clerk-expo";
import { Redirect } from "expo-router";
import { Text, View } from "react-native";

const Home = () => {
  const { isSignedIn, isLoaded } = useAuth();
  const { user } = useUser();

  // Loading state
  if (!isLoaded) {
    return null;
  }

  // Redirect if not signed in
  if (!isSignedIn) {
    return <Redirect href="/(auth)/welcome" />;
    // return <Redirect href="/(auth)/sign-in" />;
  }

  const accountType = user?.publicMetadata.accountType;

  if (accountType === "admin") {
    return <Redirect href="/(root)/(tabs)/home" />; // Redirect to driver page
  }

  if (accountType === "driver") {
    return <Redirect href="/(root)/(tabs)/home" />;
  }

  return <Redirect href="/(auth)/main" />;
};

export default Home;
