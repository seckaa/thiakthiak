import { neon } from "@neondatabase/serverless";

export async function POST(request: Request) {
  const { clerk_id, tripAmount } = await request.json();
  console.log("Received clerk_id:", clerk_id);
  console.log("Received tripAmount:", tripAmount);

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

    // const currentBalance = result[0].balance;

    // // Check if the balance is too low for the trip amount
    // if (currentBalance < tripAmount) {
    //   return new Response(JSON.stringify({ error: "Low balance" }), {
    //     status: 400,
    //   });
    // }

    // Update the balance
    // const response =
    await sql`UPDATE banks SET balance = balance - ${parseFloat(tripAmount)} WHERE clerk_id = ${clerk_id}`;
    // return Response.json({ data: response[0] }, { status: 201 });

    return new Response(
      JSON.stringify({
        message: "Balance updated successfully",
        // newBalance: currentBalance - tripAmount,
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
