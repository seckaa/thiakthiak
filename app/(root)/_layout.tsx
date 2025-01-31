import SocketContextComponent from "@/contexts/SocketContextComponent";
import { Stack } from "expo-router";

const Layout = () => {
  return (
    <SocketContextComponent>
      <Stack>
        <Stack.Screen name="(tabs)" options={{ headerShown: false }} />
        <Stack.Screen name="find-ride" options={{ headerShown: false }} />
        <Stack.Screen
          name="confirm-ride"
          options={{
            headerShown: false,
          }}
        />
        <Stack.Screen
          name="book-ride"
          options={{
            headerShown: false,
          }}
        />
      </Stack>
    </SocketContextComponent>
  );
};

export default Layout;
