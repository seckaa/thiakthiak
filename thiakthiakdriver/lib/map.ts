import { Driver, MarkerData } from "@/types/type";

// const directionsAPI = process.env.EXPO_PUBLIC_DIRECTIONS_API_KEY;
const directionsAPI = process.env.EXPO_PUBLIC_GOOGLE_API_KEY;

export const generateMarkersFromData = ({
  // use to mock drivers location
  data,
  userLatitude,
  userLongitude,
}: {
  data: Driver[];
  userLatitude: number;
  userLongitude: number;
}): MarkerData[] => {
  return data.map((driver) => {
    // const latOffset = (Math.random() - 0.5) * 0.01; // Random offset between -0.005 and 0.005
    // const lngOffset = (Math.random() - 0.5) * 0.01; // Random offset between -0.005 and 0.005

    return {
      latitude: driver.latitude!,
      longitude: driver.longitude!,

      title: `${driver.first_name} ${driver.last_name}`,
      ...driver,
    };
  });
};

// export const generateMarkersForDrivers = ({
//   data,
// }: {
//   data: Driver[];
// }): Driver[] => {
//   return data.map((driver) => {
//     return {
//       latitude: driver.latitude!,
//       longitude: driver.longitude!,

//       title: `${driver.first_name} ${driver.last_name}`,
//       ...driver,
//     };
//   });
// };

export const calculateRegion = ({
  userLatitude,
  userLongitude,
  destinationLatitude,
  destinationLongitude,
}: {
  userLatitude: number | null;
  userLongitude: number | null;
  destinationLatitude?: number | null;
  destinationLongitude?: number | null;
}) => {
  if (!userLatitude || !userLongitude) {
    return {
      latitude: 37.78825,
      longitude: -122.4324,
      latitudeDelta: 0.01,
      longitudeDelta: 0.01,
    };
  }

  if (!destinationLatitude || !destinationLongitude) {
    return {
      latitude: userLatitude,
      longitude: userLongitude,
      latitudeDelta: 0.01,
      longitudeDelta: 0.01,
    };
  }

  const minLat = Math.min(userLatitude, destinationLatitude);
  const maxLat = Math.max(userLatitude, destinationLatitude);
  const minLng = Math.min(userLongitude, destinationLongitude);
  const maxLng = Math.max(userLongitude, destinationLongitude);

  const latitudeDelta = (maxLat - minLat) * 1.3; // Adding some padding
  const longitudeDelta = (maxLng - minLng) * 1.3; // Adding some padding

  const latitude = (userLatitude + destinationLatitude) / 2;
  const longitude = (userLongitude + destinationLongitude) / 2;

  return {
    latitude,
    longitude,
    latitudeDelta,
    longitudeDelta,
  };
};

export const calculateDriverTimes = async ({
  markers,
  userLatitude,
  userLongitude,
  destinationLatitude,
  destinationLongitude,
}: {
  markers: MarkerData[];
  userLatitude: number | null;
  userLongitude: number | null;
  destinationLatitude: number | null;
  destinationLongitude: number | null;
}) => {
  if (
    !userLatitude ||
    !userLongitude ||
    !destinationLatitude ||
    !destinationLongitude
  )
    return;

  try {
    const timesPromises = markers
      .map(async (marker) => {
        //to from
        const responseToUser = await fetch(
          `https://maps.googleapis.com/maps/api/directions/json?origin=${marker.latitude},${marker.longitude}&destination=${userLatitude},${userLongitude}&key=${directionsAPI}`
        );
        const dataToUser = await responseToUser.json();
        const timeToUser = dataToUser.routes[0].legs[0].duration.value; // Time in seconds

        //to destination
        const responseToDestination = await fetch(
          `https://maps.googleapis.com/maps/api/directions/json?origin=${userLatitude},${userLongitude}&destination=${destinationLatitude},${destinationLongitude}&key=${directionsAPI}`
        );
        const dataToDestination = await responseToDestination.json();
        const timeToDestination =
          dataToDestination.routes[0].legs[0].duration.value; // Time in seconds

        const totalTime = (timeToUser + timeToDestination) / 60; // Total time in minutes for the whole trip
        const price = totalTime * 0.5; // Calculate price based on time
        const tax = price * 0.2;
        const tPrice = (price + tax).toFixed(2);

        return {
          ...marker,
          time: totalTime,
          timeToUser: timeToUser / 60,
          price: tPrice,
        };
      })
      .slice(0, 4);
    // console.log("timesPromises", timesPromises);

    //  return await Promise.all(timesPromises);

    //   } catch (error) {
    //     console.error("Error calculating driver times:", error);
    //   }
    const result = await Promise.all(timesPromises);

    return result.sort((a, b) => a.time - b.time);
  } catch (error) {
    console.error("Error calculating driver times:", error);
  }
};

// export const generateMarkersFromDatatest = ({
//   data,
//   userLatitude,
//   userLongitude,
// }: {
//   data: Driver[];
//   userLatitude: number;
//   userLongitude: number;
// }): MarkerData[] => {
//   return data.map((driver) => {
//     const latOffset = (Math.random() - 0.5) * 0.01; // Random offset between -0.005 and 0.005
//     const lngOffset = (Math.random() - 0.5) * 0.01; // Random offset between -0.005 and 0.005

//     return {
//       latitude: userLatitude + latOffset,
//       longitude: userLongitude + lngOffset,
//       title: `${driver.first_name} ${driver.last_name}`,
//       ...driver,
//     };
//   });
// };
