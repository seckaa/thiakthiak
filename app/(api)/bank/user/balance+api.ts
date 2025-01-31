import { neon } from "@neondatabase/serverless";

export async function POST(request: Request) {
  const { clerk_id, tripAmount } = await request.json();

  try {
    const sql = neon(`${process.env.DATABASE_URL}`);

    // Select current balance
    const result =
      await sql`SELECT balance FROM banks WHERE clerk_id = ${clerk_id}`;

    if (result.length === 0) {
      return new Response(JSON.stringify({ error: "Account not found" }), {
        status: 404,
      });
    }

    const currentBalance = result[0].balance;

    return new Response(
      JSON.stringify({
        currentBalance: currentBalance,
      }),
      { status: 200 }
    );
  } catch (error) {
    console.error("Error updating balance:", error);
    return new Response(JSON.stringify({ error: "Internal Server Error" }), {
      status: 500,
    });
  }
}
