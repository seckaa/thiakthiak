import { useLocationStore } from "@/store";
import { Driver } from "@/types/type";
import { neon } from "@neondatabase/serverless";
import { useState } from "react";

export async function GET(request: Request) {
  try {
    const sql = neon(`${process.env.DATABASE_URL}`);
    // const response = await sql`SELECT * FROM drivers WHERE status='ready' OR 'taken'`;
    const response =
      await sql`SELECT * FROM drivers WHERE status='ready' OR status='taken'`;

    // return Response.json({ data: response });
    return new Response(JSON.stringify({ data: response }), {
      status: 201,
    });
  } catch (error) {
    console.error("Error fetching drivers:", error);
    return Response.json({ error: "Internal Server Error" }, { status: 500 });
  }
}

// const directionsAPI = process.env.EXPO_PUBLIC_GOOGLE_API_KEY;
// const { userLatitude, userLongitude } = useLocationStore();

// export async function GET(request: Request) {
//   const [closestDriver, setclosestDriver] = useState<Driver[]>();
//   try {
//     const sql = neon(`${process.env.DATABASE_URL}`);
//     const drivers = await sql`SELECT * FROM drivers WHERE status=false`;
//     let time = Infinity;
//     let closest: Driver[];

//     drivers.forEach(async ({ driver }) => {
//       const responseToUser = await fetch(
//         `https://maps.googleapis.com/maps/api/directions/json?origin=${driver.latitude},${driver.longitude}&destination=${userLatitude},${userLongitude}&key=${directionsAPI}`
//       );
//       const dataToUser = await responseToUser.json();
//       const timeToUser = dataToUser.routes[0].legs[0].duration.value; // Time in seconds

//       if (timeToUser < time) {
//         time = timeToUser;
//         closest = driver;
//       }
//       setclosestDriver(closest);

//       console.log(closestDriver);
//     });

//     return Response.json({ data: drivers });
//     // return Response.json({ data: closestDriver });
//   } catch (error) {
//     console.error("Error fetching drivers:", error);
//     return Response.json({ error: "Internal Server Error" }, { status: 500 });
//   }
// }
