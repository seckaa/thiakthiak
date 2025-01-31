import { neon } from "@neondatabase/serverless";

export async function POST(request: Request) {
  try {
    const body = await request.json();
    const { id } = body; // Get the id from the request body
    console.log("Received ID:", id);

    const sql = neon(`${process.env.DATABASE_URL}`);

    // Fetch driver status from the database
    const status = await sql`SELECT status FROM rides WHERE id = ${id}`;

    if (status.length === 0) {
      return new Response(JSON.stringify({ error: "Driver not found" }), {
        status: 404,
      });
    }

    console.log("SQL response:", status);
    return new Response(JSON.stringify({ data: status[0] }), { status: 200 });
  } catch (error) {
    console.error("Error fetching drivers:", error);
    return new Response(JSON.stringify({ error: "Internal Server Error" }), {
      status: 500,
    });
  }
}
