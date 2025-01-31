import { Ride } from "@/types/type";
import { neon } from "@neondatabase/serverless";

// export async function GET(req: Request, { id }: { id: string }) {
//   let lastRideId = null;
//   try {
//     const sql = neon(`${process.env.DATABASE_URL}`);
//     // const result =
//     //   await sql
//     //   `SELECT id FROM rides WHERE driver_id=${id} ORDER BY id DESC LIMIT 1`;

//     const result =
//       await sql
//       `SELECT id FROM rides WHERE driver_id=${id} ORDER BY id DESC LIMIT 1`;
//       // `SELECT id (SELECT
//       //           rides.ride_id,
//       //           rides.origin_address,
//       //           rides.destination_address,
//       //           rides.origin_latitude,
//       //           rides.origin_longitude,
//       //           rides.destination_latitude,
//       //           rides.destination_longitude,
//       //           rides.ride_time,
//       //           rides.fare_price,
//       //           rides.payment_status,
//       //           rides.created_at,
//       //           'driver', json_build_object(
//       //               'driver_id', drivers.id,
//       //               'first_name', drivers.first_name,
//       //               'last_name', drivers.last_name,
//       //               'profile_image_url', drivers.profile_image_url,
//       //               'car_image_url', drivers.car_image_url,
//       //               'car_seats', drivers.car_seats,
//       //               'rating', drivers.rating
//       //           ) AS driver
//       //       FROM
//       //           rides
//       //       INNER JOIN
//       //           drivers ON rides.driver_id = drivers.id
//       //       WHERE
//       //           drivers.clerk_id = ${id}
//       //       ORDER BY
//       //           rides.created_at DESC)`;
//     if (!result.length) {
//       return Response.json({ code: -1 });
//     }
//     const currentRideId = result[0].id;
//     const rideNewId = lastRideId;

//     if (!rideNewId) {
//       lastRideId = currentRideId;
//       return Response.json({ code: -1 });
//     }
//     if (rideNewId < currentRideId) {
//       lastRideId = currentRideId;
//       return Response.json({ code: 0, data: currentRideId });
//     } else {
//       lastRideId = currentRideId;
//     }
//     return Response.json({ code: -1, data: rideNewId });
//   } catch (error) {
//     console.error("Error fetching new ride:", error);
//     return Response.json({ code: -1 });
//   }
// }

// import { neon } from "@neondatabase/serverless";

export async function GET(request: Request, { id }: { id: string }) {
  if (!id)
    return Response.json({ error: "Missing required fields" }, { status: 400 });

  try {
    const sql = neon(`${process.env.DATABASE_URL}`);
    const response = await sql`SELECT rides.ride_id, rides.origin_address,
                                  rides.destination_address,
                                  CAST(rides.origin_latitude AS DECIMAL(9,7)),
                                  CAST(rides.origin_longitude AS DECIMAL(9,7)),
                                  CAST(rides.destination_latitude AS DECIMAL(9,7)),
                                  rides.destination_longitude::NUMERIC(9,7),
                                  rides.ride_time,
                                  rides.fare_price,
                                  rides.payment_status,
                                  rides.created_at,
                                  rides.status,
                                  rides.user_id,
                                  json_build_object
                                              (
                                                'driver_id', drivers.id,
                                                'first_name', drivers.first_name,
                                                'last_name', drivers.last_name,
                                                'profile_image_url', drivers.profile_image_url,
                                                'car_image_url', drivers.car_image_url,
                                                'car_seats', drivers.car_seats,
                                                'rating', drivers.rating
                                              )
                                  AS driver FROM rides INNER JOIN drivers ON rides.driver_id = drivers.id
                                  WHERE
                                    drivers.clerk_id = ${id}
                                      AND
                                    rides.status = 'new'

                                   ORDER BY rides.created_at DESC LIMIT 1`;

    // const mydata: Ride[] = [
    //   {
    //     ride_id: Number(response.ride_id),
    //     origin_address: response.origin_address,
    //     destination_address:
    //       response.destination_address,
    //     origin_latitude: Number(
    //       response.origin_latitude
    //     ),
    //     origin_longitude: Number(
    //       response.origin_latitude
    //     ),
    //     destination_latitude: Number(
    //       response.destination_latitude
    //     ),
    //     destination_longitude: Number(
    //       response.destination_longitude
    //     ),
    //     ride_time: Number(response.ride_time),
    //     fare_price: Number(response.fare_price),
    //     payment_status: response.payment_status,
    //     driver: response.driver,
    //     driver_id: Number(
    //       response.destination_longitude
    //     ),
    //     user_id: response.user_id,
    //     created_at: response.created_at,
    //     status: response.status,
    //   },
    // ];

    return Response.json({ data: response });
    // return new Response(JSON.stringify({ data: response }), {
    //   status: 201,
    // });
  } catch (error) {
    console.error("Error fetching drivers:", error);
    return Response.json({ error: "Internal Server Error" }, { status: 500 });
  }
}

const ride = [
  {
    created_at: "2024-09-23T23:52:27.772Z",
    destination_address: "89 South Street, New York, NY, USA",
    destination_latitude: "40.706210",
    destination_longitude: "-74.003491",
    driver: {
      car_image_url:
        "https://ucarecdn.com/289764fb-55b6-4427-b1d1-f655987b4a14/-/preview/930x932/",
      car_seats: 4,
      driver_id: 3,
      first_name: "Die",
      last_name: "Gaye",
      profile_image_url:
        "https://ucarecdn.com/0330d85c-232e-4c30-bd04-e5e4d0e3d688/-/preview/826x822/",
      rating: 4.7,
    },
    fare_price: "2100.00",
    origin_address: "663, New York",
    origin_latitude: "40.907266",
    origin_longitude: "-73.850072",
    payment_status: "paid",
    ride_id: 1,
    ride_time: 44,
  },
  {
    created_at: "2024-09-24T04:31:49.352Z",
    destination_address: "78 Stratton Street South, Yonkers, NY, USA",
    destination_latitude: "40.941391",
    destination_longitude: "-73.877373",
    driver: {
      car_image_url:
        "https://ucarecdn.com/289764fb-55b6-4427-b1d1-f655987b4a14/-/preview/930x932/",
      car_seats: 4,
      driver_id: 3,
      first_name: "Die",
      last_name: "Gaye",
      profile_image_url:
        "https://ucarecdn.com/0330d85c-232e-4c30-bd04-e5e4d0e3d688/-/preview/826x822/",
      rating: 4.7,
    },
    fare_price: "800.00",
    origin_address: "663, New York",
    origin_latitude: "40.907245",
    origin_longitude: "-73.850065",
    payment_status: "paid",
    ride_id: 2,
    ride_time: 17,
  },
  {
    created_at: "2024-09-24T04:44:55.120Z",
    destination_address: "59x Rue 64, Gueule Tapee, Dakar, Senegal",
    destination_latitude: "14.683518",
    destination_longitude: "-17.458638",
    driver: {
      car_image_url:
        "https://ucarecdn.com/289764fb-55b6-4427-b1d1-f655987b4a14/-/preview/930x932/",
      car_seats: 4,
      driver_id: 3,
      first_name: "Die",
      last_name: "Gaye",
      profile_image_url:
        "https://ucarecdn.com/0330d85c-232e-4c30-bd04-e5e4d0e3d688/-/preview/826x822/",
      rating: 4.7,
    },
    fare_price: "300.00",
    origin_address: "Medina, Dakar, Senegal",
    origin_latitude: "14.682200",
    origin_longitude: "-17.450951",
    payment_status: "paid",
    ride_id: 3,
    ride_time: 8,
  },
];

//  `SELECT
//             rides.ride_id,
//             rides.origin_address,
//             rides.destination_address,
//             rides.origin_latitude,
//             rides.origin_longitude,
//             rides.destination_latitude,
//             rides.destination_longitude,
//             rides.ride_time,
//             rides.fare_price,
//             rides.payment_status,
//             rides.created_at,
//             'driver', json_build_object(
//                 'driver_id', drivers.id,
//                 'first_name', drivers.first_name,
//                 'last_name', drivers.last_name,
//                 'profile_image_url', drivers.profile_image_url,
//                 'car_image_url', drivers.car_image_url,
//                 'car_seats', drivers.car_seats,
//                 'rating', drivers.rating
//             ) AS driver
//         FROM
//             rides
//         INNER JOIN
//             drivers ON rides.driver_id = drivers.id
//         WHERE
//             rides.user_id = ${id}
//         ORDER BY
//             rides.created_at DESC;
//     `
