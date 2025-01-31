import { Redirect } from "expo-router";
import { useAuth, useUser } from "@clerk/clerk-expo";
import { View } from "react-native";

export default function AdminRoute() {
  const { isLoaded, isSignedIn } = useAuth();

  const { user } = useUser();

  if (!isLoaded) {
    return null; // Loading state
  }

  if (!isSignedIn) {
    return <Redirect href="/(auth)/sign-in" />; // Redirect to login if not signed in
  }

  if (user?.publicMetadata.accountType !== "admin") {
    return <Redirect href="/" />; // Redirect to home if not an admin
  }

  return <View>{/* Content for admin users */}</View>;
}
