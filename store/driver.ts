import { useFetch } from "@/lib/fetch";
import { Driver, MarkerData, Ride } from "@/types/type";
import { create } from "zustand";

///////////////////////////////useDriverLocationStore ///////////////////
export const useDriverLocationStore = create<DriverLocationStore>((set) => ({
  driverLatitude: null,
  driverLongitude: null,
  driverAddress: null,
  driverDestinationLatitude: null,
  driverDestinationLongitude: null,
  driverDestinationAddress: null,
  setDriverLocation: ({
    latitude,
    longitude,
    address,
  }: {
    latitude: number;
    longitude: number;
    address: string;
  }) => {
    set(() => ({
      driverLatitude: latitude,
      driverLongitude: longitude,
      driverAddress: address,
    }));
  },

  setDriverDestinationLocation: ({
    latitude,
    longitude,
    address,
  }: {
    latitude: number;
    longitude: number;
    address: string;
  }) => {
    set(() => ({
      driverDestinationLatitude: latitude,
      driverDestinationLongitude: longitude,
      driverDestinationAddress: address,
    }));
  },
}));

declare interface DriverLocationStore {
  driverLatitude: number | null;
  driverLongitude: number | null;
  driverAddress: string | null;
  driverDestinationLatitude: number | null;
  driverDestinationLongitude: number | null;
  driverDestinationAddress: string | null;
  setDriverLocation: ({
    latitude,
    longitude,
    address,
  }: {
    latitude: number;
    longitude: number;
    address: string;
  }) => void;
  setDriverDestinationLocation: ({
    latitude,
    longitude,
    address,
  }: {
    latitude: number;
    longitude: number;
    address: string;
  }) => void;
}

///////////////////////////////useRideStore ///////////////////

export const useRideStore = create<RideStore>((set) => ({
  ride: null,
  loading: false,
  error: null,

  setRide: (ride) => set({ ride }),
  setLoading: (loading) => set({ loading }),
  setError: (error) => set({ error }),

  fetchRide: async (userId) => {
    set({ loading: true, error: null });
    try {
      const response = await fetch(`/api/driver/ride/${userId}`);
      const data = await response.json();
      set({ ride: data, loading: false });
    } catch (error) {
      set({ error: "Server error 500", loading: false });
    }
  },
  updateDriverStatus: async (userId, driverStatus) => {
    set({ loading: true, error: null });
    try {
      const response = await fetch(`/api/driver/status/${userId}`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ driverStatus }),
      });
      if (!response.ok) {
        throw new Error("Failed to update driver status");
      }
      const responseData = await response.json();
      console.log("Driver status updated:", responseData);
    } catch (error) {
      console.error("Error updating driver status:", error);
      set({ error: "Server error, please contact admin", loading: false });
    } finally {
      set({ loading: false });
    }
  },
}));

declare interface RideStore {
  ride: Ride | null;
  loading: boolean;
  error: string | null;
  setRide: (ride: Ride) => void;
  setLoading: (loading: boolean) => void;
  setError: (error: string) => void;
  fetchRide: (userId: string) => Promise<void>;
  updateDriverStatus: (userId: string, driverStatus: string) => Promise<void>;
}

// export const useRideStore = create<RideStore>((set) => ({
//   rides: [] as Ride[],
//   newRide: null,

//   setRides: (rides) => set({ rides }),
//   addRide: (ride) =>
//     set((state) => ({ rides: [...state.rides, ride], newRide: ride })),
//   clearNewRide: () => set({ newRide: null }),
// }));

// declare interface RideStore {
//   rides: Ride[];
//   newRide: Ride | null;
//   setRides: (rides: Ride[]) => void;
//   addRide: (ride: Ride) => void;
//   clearNewRide: () => void;
// }

// declare interface Ride {
//   ride_id: number;
//   origin_address: string;
//   destination_address: string;
//   origin_latitude: number;
//   origin_longitude: number;
//   destination_latitude: number;
//   destination_longitude: number;
//   ride_time: number;
//   fare_price: string;
//   payment_status: string;
//   driver_id: number;
//   user_id: string;
//   created_at?: Date;
// }
