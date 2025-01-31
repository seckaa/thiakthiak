import { neon } from "@neondatabase/serverless";

export async function POST(request: Request) {
  try {
    const body = await request.json();
    if (!body)
      return Response.json(
        { error: "Missing required fields" },
        { status: 400 }
      );

    const sql = neon(`${process.env.DATABASE_URL}`);

    const response =
      await sql`UPDATE rides SET status = ${body.status} WHERE ride_id=${body.id}`;

    console.log("SQL response:", response);
    return Response.json({ data: response[0] }, { status: 201 });
  } catch (error) {
    console.error("Error updating driver status :", error);
    return Response.json({ error: "Internal Server Error" }, { status: 500 });
  }
}
