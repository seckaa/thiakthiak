import { createContext } from "react";
import { Socket } from "socket.io-client";

//State Interface:
export interface ISocketContextState {
  socket: Socket | undefined;
  uid: string;
  users: string[];
}
//Default State: Initializes the default state for the context.
export const defaultSocketContextState: ISocketContextState = {
  socket: undefined,
  uid: "",
  users: [],
};

//Actions and Payload Types: Defines the types of actions that can be dispatched and the payload types.
export type TSocketContextActions =
  | "update_socket"
  | "update_uid"
  | "update_users"
  | "remove_user";
export type TSocketContextPayload = string | string[] | Socket;

//Action Interface:Defines the structure for the actions.
export interface ISocketContextActions {
  type: TSocketContextActions;
  payload: TSocketContextPayload;
}

//Reducer :Handles different action types to update the state.
export const SocketReducer = (
  state: ISocketContextState,
  action: ISocketContextActions
) => {
  console.log(
    "Message recieved - Action: " + action.type + " - Payload: ",
    action.payload
  );

  switch (action.type) {
    case "update_socket":
      return { ...state, socket: action.payload as Socket };
    case "update_uid":
      return { ...state, uid: action.payload as string };
    case "update_users":
      return { ...state, users: action.payload as string[] };
    case "remove_user":
      return {
        ...state,
        users: state.users.filter((uid) => uid !== (action.payload as string)),
      };
    default:
      return state;
  }
};

//Context Properties Interface:
export interface ISocketContextProps {
  SocketState: ISocketContextState;
  SocketDispatch: React.Dispatch<ISocketContextActions>;
}

//Context Creation:
const SocketContext = createContext<ISocketContextProps>({
  SocketState: defaultSocketContextState,
  SocketDispatch: () => {},
});

// Context Consumer and Provider:
export const SocketContextConsumer = SocketContext.Consumer;
export const SocketContextProvider = SocketContext.Provider;

export default SocketContext;
