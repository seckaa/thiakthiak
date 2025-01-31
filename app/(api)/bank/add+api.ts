import { neon } from "@neondatabase/serverless";

export async function POST(request: Request) {
  const { clerk_id, accountNumber, bankName } = await request.json();

  try {
    const sql = neon(`${process.env.DATABASE_URL}`);
    await sql`INSERT INTO 
     (clerk_id, account_number, bank_name)
              VALUES (${clerk_id}, ${accountNumber}, ${bankName})`;
    return new Response(
      JSON.stringify({ message: "Bank account added successfully" }),
      { status: 201 }
    );
  } catch (error) {
    console.error("Error adding bank account:", error);
    return new Response(JSON.stringify({ error: "Internal Server Error" }), {
      status: 500,
    });
  }
}
