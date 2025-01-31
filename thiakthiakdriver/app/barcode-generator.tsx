import React, { useState, useCallback, useRef } from "react";
import {
  View,
  Text,
  TextInput,
  StyleSheet,
  Button,
  Alert,
  Platform,
  PermissionsAndroid,
  Dimensions,
} from "react-native";
import Barcode from "@kichiyaki/react-native-barcode-generator";
// import { captureRef } from "react-native-view-shot";
// import Share from "react-native-share";
// import RNFetchBlob from "rn-fetch-blob";

const BarcodeGenerator: React.FC = () => {
  const [route, setRoute] = useState<string>("");
  const barcodeRef = useRef(null);

  const generateBarcodeValue = () => {
    return JSON.stringify({ route });
  };

  // const shareBarcode = useCallback(() => {
  //   captureRef(barcodeRef, {
  //     format: "jpg",
  //     quality: 0.8,
  //     result: "base64",
  //   }).then(
  //     (b64) => {
  //       const shareImageBase64 = {
  //         title: "Barcode",
  //         message: "Here is my barcode!",
  //         url: `data:image/jpeg;base64,${b64}`,
  //       };
  //       Share.open(shareImageBase64).catch((error) =>
  //         console.error("Share failed", error)
  //       );
  //     },
  //     (error) => console.error("Snapshot failed", error)
  //   );
  // }, []);

  // const downloadBarcode = useCallback(async () => {
  //   captureRef(barcodeRef, {
  //     format: "jpg",
  //     quality: 0.8,
  //     result: "base64",
  //   }).then(
  //     async (b64) => {
  //       const shareImageBase64 = {
  //         title: "Barcode",
  //         message: "Here is my barcode!",
  //         url: `data:image/jpeg;base64,${b64}`,
  //       };

  //       if (Platform.OS === "ios") {
  //         saveImage(shareImageBase64.url);
  //       } else {
  //         try {
  //           const granted = await PermissionsAndroid.request(
  //             PermissionsAndroid.PERMISSIONS.WRITE_EXTERNAL_STORAGE,
  //             {
  //               title: "Storage Permission Required",
  //               message:
  //                 "App needs access to your storage to download the barcode image",
  //               buttonPositive: "OK",
  //               buttonNegative: "Cancel",
  //               buttonNeutral: "Ask Me Later",
  //             }
  //           );
  //           if (granted === PermissionsAndroid.RESULTS.GRANTED) {
  //             console.log("Storage Permission Granted");
  //             saveImage(shareImageBase64.url);
  //           } else {
  //             console.log("Storage Permission Not Granted");
  //           }
  //         } catch (err) {
  //           console.log(err);
  //         }
  //       }
  //     },
  //     (error) => console.error("Snapshot failed", error)
  //   );
  // }, []);

  // const saveImage = (barcode: string) => {
  //   barcode = barcode.split("data:image/jpeg;base64,")[1];

  //   let date = new Date();
  //   const { fs } = RNFetchBlob;
  //   let filename =
  //     "/barcode_" +
  //     Math.floor(date.getTime() + date.getSeconds() / 2) +
  //     ".jpeg";
  //   let PictureDir = fs.dirs.DownloadDir + filename;

  //   fs.writeFile(PictureDir, barcode, "base64")
  //     .then(() => {
  //       RNFetchBlob.android.addCompleteDownload({
  //         title: "🎁 Here is your barcode!",
  //         // useDownloadManager: true,
  //         showNotification: true,
  //         // notification: true,
  //         path: PictureDir,
  //         mime: "image/jpeg",
  //         description: "Image",
  //       });
  //     })
  //     .catch((err) => {
  //       console.log("ERR: ", err);
  //     });
  // };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Generate Barcode</Text>

      <TextInput
        style={styles.input}
        placeholder="Enter Route"
        value={route}
        onChangeText={setRoute}
      />

      <View ref={barcodeRef} style={styles.barcodeContainer}>
        <Barcode
          value={generateBarcodeValue()}
          width={200}
          height={100}
          background="#fff"
          lineColor="#000"
          format="CODE128"
          text={route}
          style={{ marginBottom: 20 }}
          textStyle={{ color: "#000" }}
          maxWidth={Dimensions.get("window").width / 1.5}
        />
      </View>

      {/* <Button title="Share Barcode" onPress={shareBarcode} /> */}
      {/* <Button title="Download Barcode" onPress={downloadBarcode} /> */}
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
  barcodeContainer: {
    marginTop: 20,
    marginBottom: 20,
  },
});

export default BarcodeGenerator;
