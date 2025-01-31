const EVENTS = {
    connection: 'connect',
    CLIENT: {
        DISCONNECT: 'disconnect',
        SENDMESSAGE: 'sendMessage',
        JOINROOM: 'joinRoom',
        CREATE_ROOM: 'createRoom',
        SEND_ROOM_MESSAGE: 'sendRoomMessage',
        JOIN_ROOM: 'joinRoom',
        PRIVATE_MESSAGE: 'privateMessage',
        ORDER_RIDE: 'orderRide',
        HANDSHAKE: 'handShake'
    },
    SERVER: {
        ROOMS: 'ROOMS',
        JOINED_ROOM: 'joinRoom',
        ROOM_MESSAGE: 'ROOM_MESSAGE',
        MESSAGE: 'message',
        PRIVATE_MESSAGE: 'privateMessage',
        UPDATE_DRIVERS: 'updateDrivers'
    }
};

export default EVENTS;
