import { neon } from "@neondatabase/serverless";

export async function POST(request: Request, { id }: { id: string }) {
  try {
    const body = await request.json();
    // console.log("body", body);

    const sql = neon(`${process.env.DATABASE_URL}`);

    const response =
      await sql`UPDATE users SET longitude = ${parseFloat(body.longitude)}, latitude = ${parseFloat(body.latitude)} WHERE clerk_id=${id}`;

    return Response.json({ data: response[0] }, { status: 201 });
  } catch (error) {
    console.error("Error updating user coordonates :", error);
    return Response.json({ error: "Internal Server Error" }, { status: 500 });
  }
}
