import { Ride } from "@/types/type";
import { fetchAPI } from "./fetch";

export const sortRides = (rides: Ride[]): Ride[] => {
  const result = rides.sort((a, b) => {
    const dateA = new Date(`${a.created_at}T${a.ride_time}`);
    const dateB = new Date(`${b.created_at}T${b.ride_time}`);
    return dateB.getTime() - dateA.getTime();
  });

  return result.reverse();
};

export function formatTime(minutes: number): string {
  const formattedMinutes = +minutes?.toFixed(0) || 0;

  if (formattedMinutes < 60) {
    return `${minutes} min`;
  } else {
    const hours = Math.floor(formattedMinutes / 60);
    const remainingMinutes = formattedMinutes % 60;
    return `${hours}h ${remainingMinutes}m`;
  }
}

export function formatDate(dateString: string): string {
  const date = new Date(dateString);
  const day = date.getDate();
  const monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  const month = monthNames[date.getMonth()];
  const year = date.getFullYear();

  return `${day < 10 ? "0" + day : day} ${month} ${year}`;
}

export async function updateDriverStatus(
  selectedDriver: number,
  status: string
) {
  try {
    const response = await fetchAPI(
      `/(api)/driver/status/id/${selectedDriver}`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          status: status,
        }),
      }
    );

    console.log(`${status} mode for driver`, selectedDriver);
  } catch (error) {
    console.error("Error updating driver status:", error);
  }
}

// export function mustFind<T>(arr: Array<T>, predicate: (t: T) => boolean): T {
//   const item = arr.find(predicate);
//   if (!item) throw new Error("Item not found");

//   return item;
// }

// type Member = {
//   id: number;
//   name: string;
// };

// type Team = {
//   name: string;
//   members: Array<Member>;
//   currentMember: Member;
// };

// function getTeamByMemberId(memberId: number): Team {
//   const members: Array<Member> = [
//     /* .... */
//   ];

//   return {
//     name: "My Team",
//     members,
//     get currentMember() {
//       const member = members.find((m) => m.id === memberId);
//       if (member) return member;
//       throw new Error(`Member#${memberId} was not found`);
//     },
//   };

//   // const member = mustFind(members, (m) => m.id === memberId);

//   // return {
//   //   name: "My Team",
//   //   members,
//   //   currentMember: member,
//   // };
// }

// <div><audio id="order_notification" src="/sounds/notification.mp3"></audio>

//     <script>
//         $(document).ready(function() {
//             setInterval(function() {
//                 getNewToOrder();
//             }, 10 * 1000);
//         });
//         function getNewToOrder() {
//             // console.log("getting data");
//             $.ajax({
//                 url: "/api/get_new_order",
//                 type: 'get',
//                 data: {
//                     lastid: 1
//                 },
//                 success: function(response) {
//                     //  console.log(response.code);
//                     if (response.code == 0) {
//                         // console.log("new order" + response.data);
//                         // update
//                         // toastr.success('new order!');
//                         let music = $("#order_notification")[0];
//                         if (music.paused) {
//                             music.play();
//                         } else {
//                             music.pause();
//                         }
//                         setTimeout(function() {
//                             window.location.href = "/seller/orders/" + response.data;
//                         }, "5000");
//                     } else if (response.code == -1) {}
//                 },
//                 error: function(err) {
//                     console.log("err---》" + err);
//                 },
//             });

//         }
//     </script>

//  public function get_new_order(Request $request)
//     {
//         $res = Order::orderBy("id", "desc")->first();

//         // dd($res);

//         if (empty($res)) {
//             return response()->json(["code" => -1], 200);
//         }
//         $id = $res->id;
//         $order_new_id = cache()->get("order_new_id");

//         if (empty($order_new_id)) {
//             cache()->put("order_new_id", $id);
//             return response()->json(["code" => -1], 200);
//         }

//         if ($order_new_id < $id) {
//             cache()->put("order_new_id", $id);
//             return response()->json(["code" => 0, "data" => $id], 200);
//         } else {
//             cache()->put("order_new_id", $id);
//         }
//         return response()->json(["code" => -1, "data" => $order_new_id], 200);
//     }
