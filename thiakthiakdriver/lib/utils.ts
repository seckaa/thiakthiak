import { Ride } from "@/types/type";
import { fetchAPI } from "./fetch";

export const sortRides = (rides: Ride[]): Ride[] => {
  const result = rides.sort((a, b) => {
    const dateA = new Date(`${a.created_at}T${a.ride_time}`);
    const dateB = new Date(`${b.created_at}T${b.ride_time}`);
    return dateB.getTime() - dateA.getTime();
  });

  return result.reverse();
};

export function formatTime(minutes: number): string {
  const formattedMinutes = +minutes?.toFixed(0) || 0;

  if (formattedMinutes < 60) {
    return `${minutes} min`;
  } else {
    const hours = Math.floor(formattedMinutes / 60);
    const remainingMinutes = formattedMinutes % 60;
    return `${hours}h ${remainingMinutes}m`;
  }
}

export function formatDate(dateString: string): string {
  const date = new Date(dateString);
  const day = date.getDate();
  const monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  const month = monthNames[date.getMonth()];
  const year = date.getFullYear();

  return `${day < 10 ? "0" + day : day} ${month} ${year}`;
}

export async function updateDriverStatus(clerk_id: string, status: string) {
  try {
    await fetchAPI(`/(api)/driver/status/${clerk_id}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        status: status,
      }),
    });

    console.log(`${status} mode for driver`, clerk_id);
  } catch (error) {
    console.error("Error updating driver status:", error);
  }
}

export async function getRideStatus(id: number) {
  try {
    await fetchAPI(`/(api)/ride/status`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        id: id,
      }),
    });

    console.log(`${id} mode for ride`, id);
  } catch (error) {
    console.error("Error updating driver status:", error);
  }
}

export async function updateRideStatus(id: number, status: string) {
  try {
    const response = await fetchAPI(`/(api)/ride/update`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        status: status,
        id: id,
      }),
    });

    console.log(`${status} mode for trip`, id);
  } catch (error) {
    console.error("Error updating ride status:", error);
  }
}
