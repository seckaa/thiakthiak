import React, {
  PropsWithChildren,
  useEffect,
  useReducer,
  useState,
} from "react";
import { useSocket } from "../hooks/useSocket";
import {
  defaultSocketContextState,
  SocketContextProvider,
  SocketReducer,
} from "./SocketContext";
import { View, Text, ActivityIndicator, StyleSheet } from "react-native";

//This interface ensures the component can accept children, meaning it can wrap other components.
export interface ISocketContextComponentProps extends PropsWithChildren {}

//This defines a functional component that takes children as props.
const SocketContextComponent: React.FunctionComponent<
  ISocketContextComponentProps
> = (props) => {
  const { children } = props;

  //Socket Initialization:
  //The useSocket hook is used to initialize a socket connection with specified options.
  const socket = useSocket("ws://192.168.1.237:1337", {
    reconnectionAttempts: 5,
    reconnectionDelay: 1000,
    autoConnect: false,
  });

  //The reducer and state for managing the socket context are initialized.
  const [SocketState, SocketDispatch] = useReducer(
    SocketReducer,
    defaultSocketContextState
  );

  //The loading state is also managed here.
  const [loading, setLoading] = useState(true);

  //Effect for Initial Connection:
  //This effect runs once when the component mounts. It connects the socket,
  //dispatches the update, starts listeners, and sends an initial handshake to the server.
  useEffect(() => {
    socket.connect();
    SocketDispatch({ type: "update_socket", payload: socket });
    StartListeners();
    SendHandshake();

    // const intervalId = setInterval(reconnectAll, 1000); // 300000 ms = 5 minutes
    // return () => clearInterval(intervalId); // Clean up interval on component unmount
  }, []);

  //This function sets up various event listeners for the socket to handle user connections,
  //disconnections, and reconnection attempts.
  const StartListeners = () => {
    socket.on("user_connected", (users: string[]) => {
      console.info("User connected message received");
      SocketDispatch({ type: "update_users", payload: users });
    });

    socket.on("user_disconnected", (uid: string) => {
      console.info("User disconnected message received");
      SocketDispatch({ type: "remove_user", payload: uid });
    });

    socket.io.on("reconnect", (attempt) => {
      console.info("Reconnected on attempt: " + attempt);
      SendHandshake();
    });

    socket.io.on("reconnect_attempt", (attempt) => {
      console.info("Reconnection Attempt: " + attempt);
    });

    socket.io.on("reconnect_error", (error) => {
      console.info("Reconnection error: " + error);
    });

    socket.io.on("reconnect_failed", () => {
      console.info("Reconnection failure.");
      alert(
        "We are unable to connect you to our service. Please make sure your internet connection is stable or try again later."
      );
    });
  };
  //This function sends a handshake to the server and updates the state with the response.
  const SendHandshake = async () => {
    console.info("Sending handshake to server ...");

    socket.emit("handshake", async (uid: string, users: string[]) => {
      console.info("User handshake callback message received");
      SocketDispatch({ type: "update_users", payload: users });
      SocketDispatch({ type: "update_uid", payload: uid });
    });

    setLoading(false);
  };

  //Loading State Handling:
  if (loading)
    return (
      <ActivityIndicator style={styles.loading} size="large" color="#0000ff" />
    );

  return (
    <SocketContextProvider value={{ SocketState, SocketDispatch }}>
      {children}
    </SocketContextProvider>
  );
};

const styles = StyleSheet.create({
  loading: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
  },
});

export default SocketContextComponent;
