import { neon } from "@neondatabase/serverless";

export async function GET(request: Request, { id }: { id: number }) {
  try {
    const sql = neon(`${process.env.DATABASE_URL}`);
    const response =
      // await sql`SELECT status FROM drivers WHERE id = ${String(params.id)}`;
      await sql`SELECT status FROM drivers WHERE id = ${id}`;

    if (response.length > 0) {
      console.warn("response", response);
      return new Response(JSON.stringify({ data: response }), { status: 200 });
    } else {
      return new Response(JSON.stringify({ error: "Driver not found" }), {
        status: 404,
      });
    }
  } catch (error) {
    console.error("Error fetching driver status:", error);
    return new Response(JSON.stringify({ error: "Internal Server Error" }), {
      status: 500,
    });
  }
}
