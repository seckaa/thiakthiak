import { neon } from "@neondatabase/serverless";

export async function GET(request: Request) {
  try {
    const { id } = await request.json();

    const sql = neon(`${process.env.DATABASE_URL}`);
    const response = await sql`SELECT rides.ride_id, rides.origin_address, 
                                  rides.destination_address, 
                                  CAST(rides.origin_latitude AS DECIMAL(9,7))::numeric, 
                                  CAST(rides.origin_longitude AS DECIMAL(9,7)), 
                                  CAST(rides.destination_latitude AS DECIMAL(9,7)),
                                  CAST(rides.destination_longitude AS DECIMAL(9,7)), 
                                  rides.ride_time, 
                                  rides.fare_price, 
                                  rides.payment_status, 
                                  rides.created_at,
                                  rides.status,
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
                                  
                                   ORDER BY rides.created_at DESC`;

    return Response.json({ data: response });
    // return new Response(JSON.stringify({ data: response }), {
    //   status: 201,
    // });
  } catch (error) {
    console.error("Error fetching drivers:", error);
    return Response.json({ error: "Internal Server Error" }, { status: 500 });
  }
}
