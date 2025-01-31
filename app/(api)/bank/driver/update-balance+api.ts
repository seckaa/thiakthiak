import { neon } from "@neondatabase/serverless";

export async function POST(request: Request) {
  const { driverId, tripCommission } = await request.json();

  try {
    const sql = neon(`${process.env.DATABASE_URL}`);

    // Get clerk_id from drivers
    const result =
      await sql`SELECT clerk_id FROM drivers WHERE id = ${driverId}`;

    if (result.length === 0) {
      return new Response(JSON.stringify({ error: "Driver not found" }), {
        status: 404,
      });
    }

    const clerk_id = result[0].clerk_id;

    // Update bank account balance
    await sql`UPDATE bank SET balance = balance + ${tripCommission} WHERE clerk_id = ${clerk_id}`;

    return new Response(
      JSON.stringify({ message: "Balance updated successfully" }),
      { status: 200 }
    );
  } catch (error) {
    console.error("Error updating balance:", error);
    return new Response(JSON.stringify({ error: "Internal Server Error" }), {
      status: 500,
    });
  }
}
