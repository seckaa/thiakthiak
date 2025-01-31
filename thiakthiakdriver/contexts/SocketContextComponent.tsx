import React, {
  PropsWithChildren,
  useEffect,
  useReducer,
  useRef,
  useState,
} from "react";
import { useSocket } from "../hooks/useSocket";
import {
  defaultSocketContextState,
  SocketContextProvider,
  SocketReducer,
} from "./SocketContext";
import {
  View,
  Text,
  ActivityIndicator,
  StyleSheet,
  AppStateStatus,
  AppState,
} from "react-native";
import * as TaskManager from "expo-task-manager";
import * as BackgroundFetch from "expo-background-fetch";
import { Socket } from "socket.io-client";

//This interface ensures the component can accept children, meaning it can wrap other components.
export interface ISocketContextComponentProps extends PropsWithChildren {}

const BACKGROUND_FETCH_TASK = "background-fetch";

// Define the task
TaskManager.defineTask(BACKGROUND_FETCH_TASK, async () => {
  const socket: Socket = useSocket("ws://192.168.1.237:1337", {
    reconnectionAttempts: 5,
    reconnectionDelay: 1000,
    autoConnect: false,
    transports: ["websocket"], // Ensure WebSocket transport is used
    timeout: 60000, // Set connection timeout
  });
  const now = Date.now();

  // const socket = socketRef.current;

  try {
    console.info("Background fetch task running", now.toString());
    console.log(
      `Got background fetch call at date: ${new Date(now).toISOString()}`
    );

    socket.connect();
    // Send keep-alive message
    if (socket.connected) {
      // Perform your socket operations here, e.g., send a ping or keep-alive message
      socket.emit("ping");
      // startKeepAlive(socket);
    }

    // Perform your background task here (e.g., reconnecting a socket, fetching data, etc.)
    const response = await fetch("https://example.com/data");
    const data = await response.json();
    console.log("Fetched data:", data);

    // Indicate the task is complete and new data was fetched
    return BackgroundFetch.BackgroundFetchResult.NewData;
  } catch (err) {
    console.info("Background fetch task failed:", err);
    // Indicate the task failed return
    return BackgroundFetch.BackgroundFetchResult.Failed;
  }
});

//This defines a functional component that takes children as props.
const SocketContextComponent: React.FunctionComponent<
  ISocketContextComponentProps
> = (props) => {
  const { children } = props;
  const socketRef = useRef<Socket>(
    useSocket("ws://192.168.1.237:1337", {
      reconnectionAttempts: 5,
      reconnectionDelay: 1000,
      autoConnect: false,
      transports: ["websocket"], // Ensure WebSocket transport is used
      timeout: 60000, // Set connection timeout
    })
  );

  //Socket Initialization:
  //The useSocket hook is used to initialize a socket connection with specified options.
  // const socket = useSocket("ws://192.168.1.237:1337", {
  //   reconnectionAttempts: 5,
  //   reconnectionDelay: 1000,
  //   autoConnect: false,
  // });
  const socket = socketRef.current;
  //The reducer and state for managing the socket context are initialized.
  const [SocketState, SocketDispatch] = useReducer(
    SocketReducer,
    defaultSocketContextState
  );

  //The loading state is also managed here.
  const [loading, setLoading] = useState(true);
  const keepAliveIntervalRef = useRef<NodeJS.Timeout | null>(null); // Ref to store the interval

  const handleAppStateChange = (nextAppState: AppStateStatus) => {
    const socket = socketRef.current;
    if (nextAppState === "active") {
      console.info("App has come to the foreground", Date());
      // socket.connect();
      // startKeepAlive(socket); // Restart keep-alive interval
    } else if (nextAppState.match(/inactive|background/)) {
      console.info("App has gone to the background or inactive");

      if (keepAliveIntervalRef.current) {
        clearInterval(keepAliveIntervalRef.current);
        // Clear interval when app goes to background
        keepAliveIntervalRef.current = null;
      }
    }
  };

  // const registerBackgroundFetch = async (socket: Socket) => {
  const registerBackgroundFetch = async () => {
    try {
      await BackgroundFetch.registerTaskAsync(BACKGROUND_FETCH_TASK, {
        minimumInterval: 60 * 15, // 15 minutes
        stopOnTerminate: false,
        startOnBoot: true,
      });
      console.info("Background fetch registered successfully");
    } catch (err) {
      console.info("Background fetch registration failed:", err);
    }
  };

  // 3. (Optional) Unregister tasks by specifying the task name
  // This will cancel any future background fetch calls that match the given name
  // Note: This does NOT need to be in the global scope and CAN be used in your React components!
  const unregisterBackgroundFetchAsync = async () => {
    return BackgroundFetch.unregisterTaskAsync(BACKGROUND_FETCH_TASK);
  };

  // const startKeepAlive = (socket: Socket) => {
  //   setInterval(() => {
  //     if (socket.connected) {
  //       socket.emit("keep-alive");
  //       console.log("startKeepAlive");
  //     }
  //   }, 10000); // 10 seconds interval
  // };
  const startKeepAlive = (socket: Socket) => {
    if (keepAliveIntervalRef.current) {
      clearInterval(keepAliveIntervalRef.current);
      // Clear existing interval
    }
    keepAliveIntervalRef.current = setInterval(() => {
      if (socket.connected) {
        console.log("startKeepAlive");
        socket.emit("keep-alive");
      }
    }, 10000); // 10 seconds interval
  };

  //Effect for Initial Connection:
  //This effect runs once when the component mounts. It connects the socket,
  //dispatches the update, starts listeners, and sends an initial handshake to the server.
  // useEffect(() => {
  //   socket.connect();
  //   SocketDispatch({ type: "update_socket", payload: socket });
  //   StartListeners();
  //   SendHandshake();

  //   // const intervalId = setInterval(reconnectAll, 1000); // 300000 ms = 5 minutes
  //   // return () => clearInterval(intervalId); // Clean up interval on component unmount
  // }, []);
  useEffect(() => {
    const socket = socketRef.current;
    socket.connect();
    socket.io.engine.on("open", () => {
      console.info("Socket connection opened");
      // startKeepAlive(socket);
    });
    SocketDispatch({ type: "update_socket", payload: socket });
    StartListeners(socket);
    SendHandshake(socket);

    // Register the background fetch task
    registerBackgroundFetch;

    // Handle app state changes
    const subscription = AppState.addEventListener(
      "change",
      handleAppStateChange
    );
    return () => {
      subscription.remove();
      socket.disconnect();
      unregisterBackgroundFetchAsync;
    };
  }, []);

  //This function sets up various event listeners for the socket to handle user connections,
  //disconnections, and reconnection attempts.
  const StartListeners = (socket: Socket) => {
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
      SendHandshake(socket);
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
  const SendHandshake = async (socket: Socket) => {
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
