import { neon } from "@neondatabase/serverless";

export async function POST(request: Request, { id }: { id: string }) {
  try {
    const body = await request.json();
    console.log("Received body:", body);
    console.log("Received ID:", id);

    const sql = neon(`${process.env.DATABASE_URL}`);

    const response =
      await sql`UPDATE drivers SET status = ${body.status} WHERE id=${id}`;

    // console.log("SQL response:", response);
    return Response.json({ data: response[0] }, { status: 201 });
  } catch (error) {
    console.error("Error updating driver status :", error);
    return Response.json({ error: "Internal Server Error" }, { status: 500 });
  }
}
