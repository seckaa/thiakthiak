import { useDriverStore } from "@/store";
import { MarkerData } from "@/types/type";

export const updateDatas = () => {};

// Helper function to update drivers in the Zustand store
export function updateDrivers(drivers: MarkerData[]) {
  useDriverStore.setState((state) => ({ ...state, drivers }));
}
