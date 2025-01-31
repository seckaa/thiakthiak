import React, { useState, useEffect } from "react";
import { Text, View, StyleSheet, Button, Alert } from "react-native";
import { CameraView, Camera, BarcodeScanningResult } from "expo-camera";
import { router } from "expo-router";

export default function App() {
  const [hasPermission, setHasPermission] = useState<boolean | null>(null);
  const [scanned, setScanned] = useState(false);

  useEffect(() => {
    const getCameraPermissions = async () => {
      const { status } = await Camera.requestCameraPermissionsAsync();
      setHasPermission(status === "granted");
    };

    getCameraPermissions();
  }, []);

  //   const handleBarcodeScanned = ({ type, data }: BarcodeScanningResult) => {
  //     setScanned(true);
  //     alert(`Bar code with type ${type} and data ${data} has been scanned!`);
  //   };
  const handleBarcodeScanned = ({ type, data }: BarcodeScanningResult) => {
    setScanned(true);
    try {
      const scannedData = JSON.parse(data);
      const { route } = scannedData;
      // Navigate to the specified route
      router.push(route);
      // Alert.alert("QR Code Scanned", `Navigating to ${route}`);
    } catch (error) {
      Alert.alert("Error", "Invalid QR code format");
    }
  };

  if (hasPermission === null) {
    return <Text>Requesting for camera permission</Text>;
  }
  if (hasPermission === false) {
    return <Text>No access to camera</Text>;
  }

  return (
    <View style={styles.container}>
      <CameraView
        onBarcodeScanned={scanned ? undefined : handleBarcodeScanned}
        barcodeScannerSettings={{
          barcodeTypes: ["code128", "codabar"],
        }}
        style={StyleSheet.absoluteFillObject}
      />
      {scanned && (
        <Button title={"Tap to Scan Again"} onPress={() => setScanned(false)} />
      )}
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    flexDirection: "column",
    justifyContent: "center",
  },
});

// import React, { useState, useEffect } from "react";
// import { View, Text, Button, StyleSheet, Alert } from "react-native";
// import { BarCodeScanner } from "expo-barcode-scanner";
// import { useRideStore } from "@/store/driver";
// import { router } from "expo-router";

// const QRCodeScanner = () => {
//   const [hasPermission, setHasPermission] = useState<boolean | null>(null);
//   const [scanned, setScanned] = useState(false);
//   const { setRide } = useRideStore();

//   useEffect(() => {
//     const getBarCodeScannerPermissions = async () => {
//       const { status } = await BarCodeScanner.requestPermissionsAsync();
//       setHasPermission(status === "granted");
//     };

//     getBarCodeScannerPermissions();
//   }, []);

//   const handleBarCodeScanned = ({
//     type,
//     data,
//   }: {
//     type: string;
//     data: string;
//   }) => {
//     setScanned(true);
//     try {
//       const scannedData = JSON.parse(data);
//       const { route } = scannedData;
//       router.push(route);
//     } catch (error) {
//       Alert.alert("Error", "Invalid QR code format");
//     }
//   };

//   if (hasPermission === null) {
//     return <Text>Requesting for camera permission</Text>;
//   }
//   if (hasPermission === false) {
//     return <Text>No access to camera</Text>;
//   }

//   return (
//     <View style={styles.container}>
//       <BarCodeScanner
//         onBarCodeScanned={scanned ? undefined : handleBarCodeScanned}
//         style={StyleSheet.absoluteFillObject}
//       />
//       {scanned && (
//         <Button title={"Tap to Scan Again"} onPress={() => setScanned(false)} />
//       )}
//     </View>
//   );
// };

// const styles = StyleSheet.create({
//   container: {
//     flex: 1,
//     justifyContent: "center",
//     alignItems: "center",
//   },
// });

// export default QRCodeScanner;
