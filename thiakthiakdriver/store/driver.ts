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
  rideStatus: "toOrigin",
  // rideDest: {
  //   latitude: null,
  //   longitude: null,
  // },
  // setRideDest: (rideDest) =>
  //   set((state) => ({ rideDest: { ...state.rideDest, ...rideDest } })),
  setRideStatus: (rideStatus) => set({ rideStatus }),
  setRide: (ride) => set({ ride }),
  setLoading: (loading) => set({ loading }),
  setError: (error) => set({ error }),
  // fetchRides: async (userId) => {
  //   set({ loading: true, error: null });
  //   try {
  //     const response = await fetch(`/api/driver/ride/rides`, {
  //       method: "GET",

  //       headers: {
  //         "Content-Type": "application/json",
  //       },
  //       body: JSON.stringify({
  //         id: userId,
  //       }),
  //     });
  //     const data = await response.json();
  //     set({ rides: data, loading: false });
  //   } catch (error) {
  //     set({ error: "Server error 500", loading: false });
  //   }
  // },
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
  rideStatus: string;
  // rideDest: RideDest;
  loading: boolean;
  error: string | null;
  setRide: (ride: Ride) => void;
  setRideStatus: (rideStatus: string) => void;
  // setRideDest: (rideDest: RideDest) => void;
  setLoading: (loading: boolean) => void;
  setError: (error: string) => void;
  updateDriverStatus: (userId: string, driverStatus: string) => Promise<void>;
}

interface RideDest {
  latitude: number | null;
  longitude: number | null;
}
