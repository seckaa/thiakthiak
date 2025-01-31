import { useDriverLocationStore } from "@/store/driver";
import { Linking } from "react-native";

export const openGoogleMapsNavigation = (
  latitude: number,
  longitude: number
) => {
  try {
    // const url = `google.navigation:0,0?daddr=${latitude},${longitude}`;
    const url = `http://maps.google.com/?q=MY%20LOCATION@${latitude},${longitude}`;

    Linking.openURL(url);
  } catch (error) {
    console.error("Error opening Google Maps", error);
  }
};
export //OpenGoogle nav
const destinationOpenGoogleMapsNavigation = (
  fromLatitude: number,
  fromLongitude: number,
  toLatitude: number,
  toLongitude: number
) => {
  try {
    const url = `https://www.google.com/maps/dir/?api=1&origin=${fromLatitude},${fromLongitude}&destination=${toLatitude},${toLongitude}&travelmode=driving`;
    Linking.openURL(url);
  } catch (error) {
    console.error("Error opening Google Maps", error);
  }
};
