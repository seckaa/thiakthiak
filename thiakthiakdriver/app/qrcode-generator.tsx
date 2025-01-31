import { images } from "@/constants";
import { useRideStore } from "@/store/driver";
import React, { useState } from "react";
import { View, Text, TextInput, StyleSheet } from "react-native";
import QRCode from "react-native-qrcode-svg";

const QRCodeGenerator = () => {
  const [route, setRoute] = useState("");
  const { ride } = useRideStore();

  const generateQRCodeValue = () => {
    return JSON.stringify({
      route: "/(root)/touser-trip",
      // ride,
    });
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Generate QR Code</Text>

      <View style={styles.qrContainer}>
        {route || ride ? (
          <QRCode
            value={generateQRCodeValue()}
            size={200}
            logo={images.check}
          />
        ) : null}
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
    padding: 20,
  },
  title: {
    fontSize: 24,
    marginBottom: 20,
  },
  input: {
    height: 40,
    borderColor: "gray",
    borderWidth: 1,
    marginBottom: 20,
    width: "80%",
    paddingHorizontal: 10,
  },
  qrContainer: {
    marginTop: 20,
  },
});

export default QRCodeGenerator;

// import React, { useState } from "react";
// import { View, Text, TextInput, StyleSheet } from "react-native";
// import QRCode from "react-native-qrcode-svg";

// const QRCodeGenerator = () => {
//   const [route, setRoute] = useState("");
//   const [tripData, setTripData] = useState({
//     driver: "",
//     pickupLocation: "",
//     dropoffLocation: "",
//   });

//   const generateQRCodeValue = () => {
//     return JSON.stringify({
//       route,
//       tripData,
//     });
//   };

//   return (
//     <View style={styles.container}>
//       <Text style={styles.title}>Generate QR Code</Text>
//       <TextInput
//         style={styles.input}
//         placeholder="Enter Route"
//         value={route}
//         onChangeText={setRoute}
//       />
//       <TextInput
//         style={styles.input}
//         placeholder="Enter Driver's Name"
//         value={tripData.driver}
//         onChangeText={(text) => setTripData({ ...tripData, driver: text })}
//       />
//       <TextInput
//         style={styles.input}
//         placeholder="Enter Pickup Location"
//         value={tripData.pickupLocation}
//         onChangeText={(text) =>
//           setTripData({ ...tripData, pickupLocation: text })
//         }
//       />
//       <TextInput
//         style={styles.input}
//         placeholder="Enter Dropoff Location"
//         value={tripData.dropoffLocation}
//         onChangeText={(text) =>
//           setTripData({ ...tripData, dropoffLocation: text })
//         }
//       />
//       <View style={styles.qrContainer}>
//         {route ||
//         tripData.driver ||
//         tripData.pickupLocation ||
//         tripData.dropoffLocation ? (
//           <QRCode value={generateQRCodeValue()} size={200} />
//         ) : null}
//       </View>
//     </View>
//   );
// };

// const styles = StyleSheet.create({
//   container: {
//     flex: 1,
//     justifyContent: "center",
//     alignItems: "center",
//     padding: 20,
//   },
//   title: {
//     fontSize: 24,
//     marginBottom: 20,
//   },
//   input: {
//     height: 40,
//     borderColor: "gray",
//     borderWidth: 1,
//     marginBottom: 20,
//     width: "80%",
//     paddingHorizontal: 10,
//   },
//   qrContainer: {
//     marginTop: 20,
//   },
// });

// export default QRCodeGenerator;

// import React, { useState } from "react";
// import { View, Text, TextInput, StyleSheet } from "react-native";
// import QRCode from "react-native-qrcode-svg";

// const QRCodeGenerator = () => {
//   const [text, setText] = useState("");

//   return (
//     <View style={styles.container}>
//       <Text style={styles.title}>Generate QR Code</Text>
//       <TextInput
//         style={styles.input}
//         placeholder="Enter text to generate QR code"
//         value={text}
//         onChangeText={setText}
//       />
//       <View style={styles.qrContainer}>
//         {text ? <QRCode value={text} size={200} /> : null}
//       </View>
//     </View>
//   );
// };

// const styles = StyleSheet.create({
//   container: {
//     flex: 1,
//     justifyContent: "center",
//     alignItems: "center",
//     padding: 20,
//   },
//   title: {
//     fontSize: 24,
//     marginBottom: 20,
//   },
//   input: {
//     height: 40,
//     borderColor: "gray",
//     borderWidth: 1,
//     marginBottom: 20,
//     width: "80%",
//     paddingHorizontal: 10,
//   },
//   qrContainer: {
//     marginTop: 20,
//   },
// });

// export default QRCodeGenerator;
