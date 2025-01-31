import SocketContextComponent from "@/contexts/SocketContextComponent";
import { Stack } from "expo-router";

const Layout = () => {
  return (
    <SocketContextComponent>
      <Stack>
        <Stack.Screen name="(tabs)" options={{ headerShown: false }} />
        <Stack.Screen name="ready-trip" options={{ headerShown: false }} />
        <Stack.Screen name="taken-trip" options={{ headerShown: false }} />
        <Stack.Screen name="paused-trip" options={{ headerShown: false }} />
        <Stack.Screen name="waiting-trip" options={{ headerShown: false }} />
        <Stack.Screen name="onduty-trip" options={{ headerShown: false }} />
        <Stack.Screen name="touser-trip" options={{ headerShown: false }} />
        <Stack.Screen
          name="todestination-trip"
          options={{ headerShown: false }}
        />
        <Stack.Screen name="complete" options={{ headerShown: false }} />
        <Stack.Screen name="offline-trip" options={{ headerShown: false }} />
      </Stack>
    </SocketContextComponent>
  );
};

export default Layout;
