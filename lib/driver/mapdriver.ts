export const calculateRegionDriver = ({
  driverLatitude,
  driverLongitude,
  driverDestinationLatitude,
  driverDestinationLongitude,
}: {
  driverLatitude: number | null;
  driverLongitude: number | null;
  driverDestinationLatitude?: number | null;
  driverDestinationLongitude?: number | null;
}) => {
  if (!driverLatitude || !driverLongitude) {
    return {
      latitude: 37.78825,
      longitude: -122.4324,
      latitudeDelta: 0.01,
      longitudeDelta: 0.01,
    };
  }

  if (!driverDestinationLatitude || !driverDestinationLongitude) {
    return {
      latitude: driverLatitude,
      longitude: driverLongitude,
      latitudeDelta: 0.01,
      longitudeDelta: 0.01,
    };
  }

  const minLat = Math.min(driverLatitude, driverDestinationLatitude);
  const maxLat = Math.max(driverLatitude, driverDestinationLatitude);
  const minLng = Math.min(driverLongitude, driverDestinationLongitude);
  const maxLng = Math.max(driverLongitude, driverDestinationLongitude);

  const latitudeDelta = (maxLat - minLat) * 1.3; // Adding some padding
  const longitudeDelta = (maxLng - minLng) * 1.3; // Adding some padding

  const latitude = (driverLatitude + driverDestinationLatitude) / 2;
  const longitude = (driverLongitude + driverDestinationLongitude) / 2;

  return {
    latitude,
    longitude,
    latitudeDelta,
    longitudeDelta,
  };
};
