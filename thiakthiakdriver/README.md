# Welcome to your Expo app 👋

This is an [Expo](https://expo.dev) project created with [`create-expo-app`](https://www.npmjs.com/package/create-expo-app).

## Get started

1. Install dependencies

   ```bash
   npm install
   ```

2. Start the app

   ```bash
    npx expo start
   ```

In the output, you'll find options to open the app in a

- [development build](https://docs.expo.dev/develop/development-builds/introduction/)
- [Android emulator](https://docs.expo.dev/workflow/android-studio-emulator/)
- [iOS simulator](https://docs.expo.dev/workflow/ios-simulator/)
- [Expo Go](https://expo.dev/go), a limited sandbox for trying out app development with Expo

You can start developing by editing the files inside the **app** directory. This project uses [file-based routing](https://docs.expo.dev/router/introduction).

## Get a fresh project

When you're ready, run:

```bash
npm run reset-project
```

This command will move the starter code to the **app-example** directory and create a blank **app** directory where you can start developing.

## Learn more

To learn more about developing your project with Expo, look at the following resources:

- [Expo documentation](https://docs.expo.dev/): Learn fundamentals, or go into advanced topics with our [guides](https://docs.expo.dev/guides).
- [Learn Expo tutorial](https://docs.expo.dev/tutorial/introduction/): Follow a step-by-step tutorial where you'll create a project that runs on Android, iOS, and the web.

## Join the community

Join our community of developers creating universal apps.

- [Expo on GitHub](https://github.com/expo/expo): View our open source platform and contribute.
- [Discord community](https://chat.expo.dev): Chat with Expo users and ask questions.
  #   t h i a k t h i a k 
   
   #   t h i a k t h i a k 
   
   

E:\Code\typscripts\Realtime-Chat-Application-main

io.on(EVENTS.connection, (socket: Socket) => {
logger.info(`User connected ${socket.id}`);

    socket.emit(EVENTS.SERVER.ROOMS, rooms);

    /*
     * When a user creates a new room
     */
    socket.on(EVENTS.CLIENT.CREATE_ROOM, ({ roomName }) => {
      console.log({ roomName });
      // create a roomId
      const roomId = nanoid();
      // add a new room to the rooms object
      rooms[roomId] = {
        name: roomName,
      };

      socket.join(roomId);

      // broadcast an event saying there is a new room
      socket.broadcast.emit(EVENTS.SERVER.ROOMS, rooms);

      // emit back to the room creator with all the rooms
      socket.emit(EVENTS.SERVER.ROOMS, rooms);
      // emit event back the room creator saying they have joined a room
      socket.emit(EVENTS.SERVER.JOINED_ROOM, roomId);
    });

    /*
     * When a user sends a room message
     */

    socket.on(
      EVENTS.CLIENT.SEND_ROOM_MESSAGE,
      ({ roomId, message, username }) => {
        const date = new Date();

        socket.to(roomId).emit(EVENTS.SERVER.ROOM_MESSAGE, {
          message,
          username,
          time: `${date.getHours()}:${date.getMinutes()}`,
        });
      }
    );

    /*
     * When a user joins a room
     */
    socket.on(EVENTS.CLIENT.JOIN_ROOM, (roomId) => {
      socket.join(roomId);

      socket.emit(EVENTS.SERVER.JOINED_ROOM, roomId);
    });

});

======build app ========

Steps to Build Your App with EAS
Install EAS CLI: Install the EAS CLI globally on your machine:

sh
npm install -g eas-cli
Log In to Expo: Log in to your Expo account using EAS CLI:

sh
eas login
Configure EAS: Initialize EAS for your project:

eas init --id projectId
eas whoami

stop teh app
sh
eas build:configure
Update app.jsonor app.config.js: Ensure your app.json or app.config.js file is properly configured. Here's an example app.json:

json
{
"expo": {
"name": "MyApp",
"slug": "myapp",
"version": "1.0.0",
"orientation": "portrait",
"icon": "./assets/icon.png",
"splash": {
"image": "./assets/splash.png",
"resizeMode": "contain",
"backgroundColor": "#ffffff"
},
"ios": {
"supportsTablet": true,
"bundleIdentifier": "com.mycompany.myapp"
},
"android": {
"package": "com.mycompany.myapp"
}
}
}
Create a Build: Create a build for Android:

sh
eas build -p android
Follow Instructions: Follow the instructions provided by EAS to complete the build process. This may include setting up credentials and other configurations.
or this worked
eas build -pandroid --profile preview
or
eas build --platform android
or
eas build --platform all

Helpful Resources
EAS Build Documentation: EAS Build Setup

Expo Blog: Turtle Goes Out to Sea

Following these steps should help you successfully build your app using EAS. If you encounter any specific errors or need further assistance, feel free to ask. 😊🚀

What's next on your list? Any specific features or enhancements you'd like to work on?

# eas build to generate aab for google play

=========================
https://www.youtube.com/watch?v=M0fX3VpIiN8
npx expo prebuild
com.thiakthiak.app1

openssl rand hex 32

https://reactnative.dev/docs/0.70/signed-apk-android#generating-an-upload-key
Generating an upload key
You can generate a private signing key using keytool.

Windows
On Windows keytool must be run from C:\Program Files\Java\jdkx.x.x_x\bin, as administrator.

keytool -genkeypair -v -storetype PKCS12 -keystore my-upload-key.keystore -alias my-key-alias -keyalg RSA -keysize 2048 -validity 10000

This command prompts you for passwords for the keystore and key and for the Distinguished Name fields for your key. It then generates the keystore as a file called my-upload-key.keystore.

The keystore contains a single key, valid for 10000 days. The alias is a name that you will use later when signing your app, so remember to take note of the alias.

must eb done insinde bin of openjdk17
wind+X+A
to ope shell

========================
npx expo install expo-dev-client
npx expo prebuild
eas build:configure
eas build --profile development --platform android
for Ios update
"ios": {
"simulator": true
}
then run
eas build --profile development --platform ios
scan n download
npx expo start --dev-client
scan n launch app
to install ona simulator
eas build:run

for Io eas device:create

https://github.com/expo/examples/tree/master/with-stripe

please work
