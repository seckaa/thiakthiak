import { TextInputProps, TouchableOpacityProps } from "react-native";

declare interface Driver {
  id: number;
  first_name: string;
  last_name: string;
  profile_image_url: string;
  car_image_url: string;
  car_seats: number;
  rating: number;
  //added
  status?: string;
  latitude?: number;
  longitude?: number;
}

declare interface MarkerData {
  id: number;
  first_name: string;
  last_name: string;
  profile_image_url: string;
  car_image_url: string;
  car_seats: number;
  rating: number;
  latitude: number;
  longitude: number;
  title: string;
  timeToUser?: number;
  time?: number;
  price?: string;
}

declare interface MapProps {
  destinationLatitude?: number;
  destinationLongitude?: number;
  onDriverTimesCalculated?: (driversWithTimes: MarkerData[]) => void;
  selectedDriver?: number | null;
  onMapReady?: () => void;
}

declare interface ButtonProps extends TouchableOpacityProps {
  title: string;
  bgVariant?: "primary" | "secondary" | "danger" | "outline" | "success";
  textVariant?: "primary" | "default" | "secondary" | "danger" | "success";
  IconLeft?: React.ComponentType<any>;
  IconRight?: React.ComponentType<any>;
  className?: string;
}

declare interface RideLayoutProps extends TouchableOpacityProps {
  title: string;
  snapPoints?: string[];
  children: React.ReactNode;
}
declare interface GoogleInputProps {
  icon?: string;
  initialLocation?: string;
  containerStyle?: string;
  textInputBackgroundColor?: string;
  handlePress: ({
    latitude,
    longitude,
    address,
  }: {
    latitude: number;
    longitude: number;
    address: string;
  }) => void;
}

declare interface InputFieldProps extends TextInputProps {
  label: string;
  icon?: any;
  secureTextEntry?: boolean;
  labelStyle?: string;
  containerStyle?: string;
  inputStyle?: string;
  iconStyle?: string;
  className?: string;
}

declare interface PaymentProps {
  fullName: string;
  email: string;
  amount: string;
  driverId: number;
  rideTime: number;
  isCash: boolean;
  tax?: number;
}

declare interface LocationStore {
  userLatitude: number | null;
  userLongitude: number | null;
  userAddress: string | null;
  destinationLatitude: number | null;
  destinationLongitude: number | null;
  destinationAddress: string | null;
  setUserLocation: ({
    latitude,
    longitude,
    address,
  }: {
    latitude: number;
    longitude: number;
    address: string;
  }) => void;
  setDestinationLocation: ({
    latitude,
    longitude,
    address,
  }: {
    latitude: number;
    longitude: number;
    address: string;
  }) => void;

  // resetUserLocation: () => void;
}

declare interface DriverStore {
  drivers: MarkerData[];
  // loading?: boolean;
  // error?: string | null;
  selectedDriver: number | null;
  setSelectedDriver: (driverId: number) => void;
  setDrivers: (drivers: MarkerData[]) => void;
  clearSelectedDriver: () => void;
  refetchDrivers: () => Promise<void>;
  removeDriverById: (driverId: number) => void;
  clearDrivers;
}

declare interface DriverCardProps {
  item: MarkerData;
  selected: number;
  setSelected: () => void;
}

// added
declare interface PaymentTypeProps {
  isCash: boolean;
  setIsCash: (state: boolean) => void;
}

// added

declare interface DriverStatusTypeProps {
  isReady: boolean;
  setisReady: (state: boolean) => void;
}

// Interface for RideStore
declare interface RideStore {
  ride: Ride[];
  selectedRide: number | null;
  setSelectedRide: (ride_id: number) => void;
  setRide: (rides: Ride[]) => void;
  clearSelectedRide: () => void;
}

declare interface Ride {
  ride_id: number;
  origin_address: string;
  destination_address: string;
  origin_latitude: number;
  origin_longitude: number;
  destination_latitude: number;
  destination_longitude: number;
  ride_time: number;
  fare_price: number;
  payment_status: string;
  created_at: Date;
  status: string | null;
  driver: Driver;
  driver_id: number;
  user_id: number;
}
