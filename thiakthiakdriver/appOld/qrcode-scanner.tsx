import React, { useState, useEffect } from "react";
import { View, Text, Button, StyleSheet, Alert } from "react-native";
import { BarcodeScanningResult, Camera, CameraView } from "expo-camera";
import { useRideStore } from "@/store/driver";
import { router } from "expo-router";

const QRCodeScanner = () => {
  const [hasPermission, setHasPermission] = useState<boolean | null>(null);
  const [scanned, setScanned] = useState(false);
  const { setRide } = useRideStore();

  useEffect(() => {
    const getCameraPermissions = async () => {
      const { status } = await Camera.requestCameraPermissionsAsync();
      setHasPermission(status === "granted");
    };

    getCameraPermissions();
  }, []);

  // const handleBarcodeScanned = ({ type, data }: BarcodeScanningResult) => {
  //   setScanned(true);
  //   Alert.alert("QR Code Scanned", `Type: ${type}\nData: ${data}`);
  // };

  const handleBarcodeScanned = ({ type, data }: BarcodeScanningResult) => {
    setScanned(true);
    try {
      const scannedData = JSON.parse(data);
      const { route, ride } = scannedData;
      // Set the ride information in the store
      setRide(ride);
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
    <View className="flex flex-col flex-1 justify-center">
      <CameraView
        onBarcodeScanned={scanned ? undefined : handleBarcodeScanned}
        barcodeScannerSettings={{
          barcodeTypes: ["qr", "pdf417"],
        }}
        style={StyleSheet.absoluteFillObject}
      />
      {scanned && (
        <Button title={"Tap to Scan Again"} onPress={() => setScanned(false)} />
      )}
    </View>
  );
};
export default QRCodeScanner;

// ------------------------ NOT IN USED
//expo install expo-barcode-scanner

// import React, { useState, useEffect } from "react";
// import { View, Text, Button, StyleSheet, Alert } from "react-native";
// import { BarCodeScanner } from "expo-barcode-scanner";

// const QRCodeScanner = () => {
//   const [hasPermission, setHasPermission] = useState<boolean | null>(null);
//   const [scanned, setScanned] = useState(false);

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
//     Alert.alert("QR Code Scanned", `Type: ${type}\nData: ${data}`);
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
