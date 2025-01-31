import { Server as HttpServer } from 'http';
import { Socket, Server } from 'socket.io';
import { v4 } from 'uuid';
import EVENTS from '../../config/events';

export class ServerSocket {
    public static instance: ServerSocket;
    public io: Server;

    /** Master list of all connected users */
    public users: { [uid: string]: string };

    constructor(server: HttpServer) {
        ServerSocket.instance = this;
        this.users = {};
        this.io = new Server(server, {
            serveClient: false,
            pingInterval: 10000,
            pingTimeout: 5000,
            cookie: false,
            cors: {
                origin: ['http://192.168.1.237', 'http://localhost']
                // origin: ['http://192.168.1.237', 'http://localhost', '*']
            }
        });

        this.io.on('connect', this.StartListeners);
    }

    StartListeners = (socket: Socket) => {
        console.info('Message received from ' + socket.id);

        socket.on('handshake', (callback: (uid: string, users: string[]) => void) => {
            console.info('Handshake received from: ' + socket.id);

            const reconnected = Object.values(this.users).includes(socket.id);

            if (reconnected) {
                console.info('This user has reconnected.');

                const uid = this.GetUidFromSocketID(socket.id);
                const users = Object.values(this.users);

                if (uid) {
                    console.info('Sending callback for reconnect ...');
                    callback(uid, users);
                    return;
                }
            }

            const uid = v4();
            this.users[uid] = socket.id;

            const users = Object.values(this.users);
            console.info('Sending callback ...');
            callback(uid, users);

            this.SendMessage(
                'user_connected',
                users.filter((id) => id !== socket.id),
                users
            );
        });

        socket.on('disconnect', () => {
            console.info('Disconnect received from: ' + socket.id);

            const uid = this.GetUidFromSocketID(socket.id);

            if (uid) {
                delete this.users[uid];

                const users = Object.values(this.users);

                this.SendMessage('user_disconnected', users, socket.id);
            }
        });

        // Listen for order
        socket.on(EVENTS.CLIENT.ORDER_RIDE, (payload) => {
            console.info('Order placed,', payload);

            // const { driverId, status, user, rideInfo } = payload;
            const data = payload;
            const driverId = data.payload.driverId;
            const user = data.payload.user;
            const status = data.payload.status;
            const rideInfo = data.payload.rideInfo;

            // Broadcast the message to all connected clients
            // socket.broadcast.emit(EVENTS.SERVER.UPDATE_DRIVERS, payload);

            //sen to a given driver
            const room = String(driverId) + 'order';
            socket.broadcast.emit(room, { driverId: driverId, user: user, status: status, rideInfo: rideInfo });
            console.log('Sending notification to driver# ', payload);
        });

        // Listen for a given driver status change
        socket.on(EVENTS.CLIENT.PRIVATE_MESSAGE, (payload) => {
            const data = payload;
            const driverId = data.payload.driverId;
            const user = data.payload.user;
            const status = data.payload.status;
            console.info('Get the msg for a driver with id: ', driverId, user, status);
            //join a room
            // socket.join(driverId+99)

            //sen to a given driver
            const room = String(driverId) + 'status';
            socket.broadcast.emit(room, { driverId: driverId, user: user, status: status });
            console.log('Sending notification to driver# ', payload);
        });
    };

    GetUidFromSocketID = (id: string) => {
        return Object.keys(this.users).find((uid) => this.users[uid] === id);
    };

    SendMessage = (name: string, users: string[], payload?: Object) => {
        console.info('Emitting event: ' + name + ' to', users);
        users.forEach((id) => (payload ? this.io.to(id).emit(name, payload) : this.io.to(id).emit(name)));
    };
}

// -----------
// import { useEffect, useState, useCallback } from 'react';
// import { Server as HttpServer } from 'http';
// import { Socket, Server } from 'socket.io';
// import { v4 } from 'uuid';
// import EVENTS from '../../config/events';

// const useServerSocket = (server: HttpServer) => {
//   const [io, setIo] = useState<Server>();
//   const [users, setUsers] = useState<{ [uid: string]: string }>({});

//   useEffect(() => {
//     const newIo = new Server(server, {
//       serveClient: false,
//       pingInterval: 10000,
//       pingTimeout: 5000,
//       cookie: false,
//       cors: {
//         origin: ['http://192.168.1.237', 'http://localhost']
//       }
//     });

//     setIo(newIo);

//     newIo.on('connect', (socket: Socket) => {
//       console.info('Message received from ' + socket.id);
//       startListeners(socket, newIo);
//     });

//     return () => {
//       newIo.close();
//     };
//   }, [server]);

//   const startListeners = useCallback((socket: Socket, io: Server) => {
//     socket.on('handshake', (callback: (uid: string, users: string[]) => void) => {
//       console.info('Handshake received from: ' + socket.id);

//       const reconnected = Object.values(users).includes(socket.id);

//       if (reconnected) {
//         console.info('This user has reconnected.');

//         const uid = getUidFromSocketID(socket.id);
//         const userList = Object.values(users);

//         if (uid) {
//           console.info('Sending callback for reconnect ...');
//           callback(uid, userList);
//           return;
//         }
//       }

//       const uid = v4();
//       setUsers((prevUsers) => ({ ...prevUsers, [uid]: socket.id }));

//       const userList = Object.values(users);
//       console.info('Sending callback ...');
//       callback(uid, userList);

//       sendMessage('user_connected', userList.filter((id) => id !== socket.id), userList, io);
//     });

//     socket.on('disconnect', () => {
//       console.info('Disconnect received from: ' + socket.id);

//       const uid = getUidFromSocketID(socket.id);

//       if (uid) {
//         setUsers((prevUsers) => {
//           const newUsers = { ...prevUsers };
//           delete newUsers[uid];
//           return newUsers;
//         });

//         const userList = Object.values(users);

//         sendMessage('user_disconnected', userList, socket.id, io);
//       }
//     });

//     // Listen for order
//     socket.on(EVENTS.CLIENT.ORDER_RIDE, (payload) => {
//       console.info('Order placed,', payload);

//       // Broadcast the message to all connected clients
//       socket.broadcast.emit(EVENTS.SERVER.UPDATE_DRIVERS, payload);
//     });

//     // Listen for a given driver status change
//     socket.on(EVENTS.CLIENT.PRIVATE_MESSAGE, (payload) => {
//       const data = payload;
//       const driverId = data.payload.driverId;
//       console.info('Get the msg for a driver with id: ', driverId);
//       // Join a room
//       const room = String(driverId) + 99;
//       socket.emit(room, { message: 'Hello', roomId: room });
//       console.log('Sending notification to driver# ', payload);
//     });
//   }, [users]);

//   const getUidFromSocketID = (id: string) => {
//     return Object.keys(users).find((uid) => users[uid] === id);
//   };

//   const sendMessage = (name: string, userList: string[], payload?: Object, io?: Server) => {
//     console.info('Emitting event: ' + name + ' to', userList);
//     userList.forEach((id) => (payload ? io?.to(id).emit(name, payload) : io?.to(id).emit(name)));
//   };

//   return {
//     io,
//     users
//   };
// };

// export default useServerSocket;
