import { create } from "zustand";
import {
  Driver,
  DriverStatusTypeProps,
  DriverStore,
  LocationStore,
  MarkerData,
  PaymentTypeProps,
} from "@/types/type";
import { useFetch } from "@/lib/fetch";

///////////////////////////////useLocationStore ///////////////////
export const useLocationStore = create<LocationStore>((set) => ({
  userLatitude: null,
  userLongitude: null,
  userAddress: null,
  destinationLatitude: null,
  destinationLongitude: null,
  destinationAddress: null,
  setUserLocation: ({
    latitude,
    longitude,
    address,
  }: {
    latitude: number;
    longitude: number;
    address: string;
  }) => {
    set(() => ({
      userLatitude: latitude,
      userLongitude: longitude,
      userAddress: address,
    }));

    // if driver is selected and now new location is set, clear the selected driver
    const { selectedDriver, clearSelectedDriver } = useDriverStore.getState();
    if (selectedDriver) clearSelectedDriver();
  },

  setDestinationLocation: ({
    latitude,
    longitude,
    address,
  }: {
    latitude: number;
    longitude: number;
    address: string;
  }) => {
    set(() => ({
      destinationLatitude: latitude,
      destinationLongitude: longitude,
      destinationAddress: address,
    }));

    // if driver is selected and now new location is set, clear the selected driver
    const { selectedDriver, clearSelectedDriver } = useDriverStore.getState();
    if (selectedDriver) clearSelectedDriver();
  },

  // resetUserLocation: () =>
  //   set(() => ({
  //     userLatitude: null,
  //     userLongitude: null,
  //     userAddress: null,
  //     destinationLatitude: null,
  //     destinationLongitude: null,
  //     destinationAddress: null,
  //   })),
}));

///////////////////////////////useDriverStore ///////////////////
export const useDriverStore = create<DriverStore>((set) => ({
  drivers: [] as MarkerData[],
  selectedDriver: null,
  // loading: false,
  // error: null,
  setSelectedDriver: (driverId: number) =>
    set(() => ({ selectedDriver: driverId })),
  setDrivers: (drivers: MarkerData[]) =>
    set((state) => ({ ...state, drivers })),
  clearSelectedDriver: () =>
    set((state) => ({ ...state, selectedDriver: null })),
  refetchDrivers: async () => {
    // Fetching drivers using your custom hook
    const {
      data: drivers,
      loading,
      error,
    } = useFetch<MarkerData[]>("/api/driver");
    // Updating the store with the fetched data
    if (!loading && !error && drivers) {
      set((state) => ({ ...state, drivers }));
    }
  },
  removeDriverById: (driverId: number) => {
    set((state) => ({
      ...state,
      drivers: state.drivers.filter((driver) => driver.id !== driverId),
    }));
  },
  clearDrivers: () => {
    set(() => ({ drivers: [] }));
  },
}));

export const useIsCashStore = create<PaymentTypeProps>((set) => ({
  isCash: true, // Initial state;
  setIsCash: () => set((state) => ({ isCash: !state.isCash })),
}));

export const useDriverStatus = create<DriverStatusTypeProps>((set) => ({
  isReady: false, // Initial state;
  setisReady: () => set((state) => ({ isReady: !state.isReady })),
}));

// export const {
//   data: ddrivers,
//   loading: dloading,
//   error: derror,
//   refetch,
// } = useFetch<MarkerData[]>("/api/driver");

// export const useDriverStore = create<DriverStore>((set) => ({
//   // WebSocket setup to listen for updates
//   // const ws = new WebSocket("wss://your-backend-endpoint");

//   // ws.onmessage = (event) => {
//   //   const updatedDrivers = JSON.parse(event.data);
//   //   set(() => ({ drivers: updatedDrivers }));
//   // };

//   drivers: ddrivers || ([] as MarkerData[]),
//   loading: dloading || false,
//   error: derror || null,
//   selectedDriver: null,
//   setSelectedDriver: (driverId: number) =>
//     set((state) => ({ ...state, selectedDriver: driverId })),
//   setDrivers: (drivers: MarkerData[]) =>
//     set((state) => ({ ...state, drivers })),
//   clearSelectedDriver: () =>
//     set((state) => ({ ...state, selectedDriver: null })),
//   refetchDrivers: async () => {
//     await refetch();
//     if (!dloading && !derror && ddrivers) {
//       set((state) => ({ ...state, ddrivers }));
//     }
//   },
// }));

///////////////////////////////useIsCashStore///////////////////
