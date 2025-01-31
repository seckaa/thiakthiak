import { useAuth, useUser } from "@clerk/clerk-expo";
import { Redirect } from "expo-router";
import { useEffect, useState } from "react";
import { Text, View } from "react-native";
// import * as Updates from "expo-updates";

const Home = () => {
  const { isSignedIn, isLoaded } = useAuth();
  const { user } = useUser();
  // console.log("User here", user?.publicMetadata.accountType); //publicMetadata

  // // force app to look for update on launch
  // useEffect(() => {
  //   async function fetchUpdateAsync() {
  //     try {
  //       const update = await Updates.checkForUpdateAsync();
  //       if (update.isAvailable) {
  //         await Updates.fetchUpdateAsync();
  //         await Updates.reloadAsync();
  //       }
  //     } catch (error) {
  //       alert(`Error Fetching expo latest update: ${error}`);
  //     }
  //   }
  //   fetchUpdateAsync();
  // }, []);

  if (!isLoaded) {
    return null; // Loading state
  }

  if (!isSignedIn) {
    return <Redirect href="/(auth)/welcome" />;
    //  return <Redirect href="/(auth)/sign-in" />; // Redirect to login if not signed in
  }

  if (user?.publicMetadata.accountType === "admin") {
    return (
      <View>
        <Text className="h-full w-full text-center flex flex-row justify-center items-center">
          Admin
        </Text>
      </View>
    ); // to be updated
    // return <Redirect href="/(admin)/(tabs)/home" />; // Redirect to home  admin
  }
  if (user?.publicMetadata.accountType === "driver") {
    // return (
    //   <View>
    //     <Text className="h-full w-full text-center flex flex-row justify-center items-center">
    //       Driver
    //     </Text>
    //   </View>
    // );
    return <Redirect href="/(auth)/main" />; // Redirect to driver page
  }

  if (
    user?.publicMetadata.accountType !== "driver" &&
    user?.publicMetadata.accountType !== "admin"
  ) {
    return <Redirect href="/(root)/(tabs)/home" />;
  }
};

export default Home;

// import { Text, View } from "react-native";
// import { SafeAreaView } from "react-native-safe-area-context";

// function Home() {
//   return (
//     <SafeAreaView>
//       <Text>Home</Text>
//     </SafeAreaView>
//   );
// }

// export default Home;

// const user = {
//   backupCodeEnabled: false,
//   cachedSessionsWithActivities: null,
//   createBackupCode: [Function],
//   createEmailAddress: [Function],
//   createExternalAccount: [Function],
//   createOrganizationEnabled: true,
//   createOrganizationsLimit: undefined,
//   createPasskey: [Function],
//   createPhoneNumber: [Function],
//   createTOTP: [Function],
//   createWeb3Wallet: [Function],
//   createdAt: "",
//   delete: [Function],
//   deleteSelfEnabled: true,
//   disableTOTP: [Function],
//   emailAddresses: [
//     {
//       attemptVerification: [Function],
//       createEmailLinkFlow: [Function],
//       destroy: [Function],
//       emailAddress: "mopointofsales@gmail.com",
//       id: "idn_2mOEWxbmVSgjh47lX7QoN9iI9jc",
//       linkedTo: [Array],
//       pathRoot: "/me/email_addresses",
//       prepareVerification: [Function],
//       toString: [Function],
//       verification: "",
//     },
//   ],
//   externalAccounts: [
//     {
//       approvedScopes:
//         "email https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile openid profile",
//       destroy: [Function],
//       emailAddress: "mopointofsales@gmail.com",
//       firstName: "momo",
//       id: "eac_2o7cVDleWL7jbCQZb0nASKVWkTv",
//       identificationId: "idn_2o7cVBl7jlFhzkNd6fm89Zw7gyt",
//       imageUrl:
//         "https://img.clerk.com/eyJ0eXBlIjoicHJveHkiLCJzcmMiOiJodHRwczovL2xoMy5nb29nbGV1c2VyY29udGVudC5jb20vYS9BQ2c4b2NMWEgyR2xrMHFrT2ZsNS03MlQyWXZwaER3azYxQmRIX05oV0FvRHJ0bzdfbndlMFE9czEwMDAtYyIsInMiOiJsOXlqUFRaQ3ptOEgwTUFnRm94d3Z2NmQxMXVybWwvN3c3clRKMEFnVkNzIn0",
//       label: null,
//       lastName: "seck",
//       pathRoot: "/me/external_accounts",
//       provider: "google",
//       providerUserId: "110744940519369269217",
//       publicMetadata: [Object],
//       reauthorize: [Function],
//       username: "",
//       verification: "",
//     },
//   ],
//   externalId: null,
//   firstName: "momo",
//   fullName: "momo seck",
//   getOrganizationInvitations: [Function],
//   getOrganizationMemberships: [Function],
//   getOrganizationSuggestions: [Function],
//   getSessions: [Function],
//   hasImage: false,
//   id: "user_2mOEbHtWRkOOb9ysCA4Int0sQMU",
//   imageUrl:
//     "https://img.clerk.com/eyJ0eXBlIjoiZGVmYXVsdCIsImlpZCI6Imluc18ybU1NaGRXR2R2N1ozcTNlQUNUVW9ZWEhwa2kiLCJyaWQiOiJ1c2VyXzJtT0ViSHRXUmtPT2I5eXNDQTRJbnQwc1FNVSIsImluaXRpYWxzIjoiTVMifQ",
//   isPrimaryIdentification: [Function],
//   lastName: "seck",
//   lastSignInAt: "",
//   leaveOrganization: [Function],
//   organizationMemberships: [],
//   passkeys: [],
//   passwordEnabled: true,
//   pathRoot: "/me",
//   phoneNumbers: [],
//   primaryEmailAddress: {
//     attemptVerification: [Function],
//     createEmailLinkFlow: [Function],
//     destroy: [Function],
//     emailAddress: "mopointofsales@gmail.com",
//     id: "idn_2mOEWxbmVSgjh47lX7QoN9iI9jc",
//     linkedTo: [""],
//     pathRoot: "/me/email_addresses",
//     prepareVerification: [Function],
//     toString: [Function],
//     verification: {
//       attempts: 1,
//       error: null,
//       expireAt: "",
//       externalVerificationRedirectURL: null,
//       nonce: null,
//       pathRoot: "",
//       status: "verified",
//       strategy: "email_code",
//       verifiedAtClient: undefined,
//       verifiedFromTheSameClient: [Function],
//     },
//   },
//   primaryEmailAddressId: "idn_2mOEWxbmVSgjh47lX7QoN9iI9jc",
//   primaryPhoneNumber: null,
//   primaryPhoneNumberId: null,
//   primaryWeb3Wallet: null,
//   primaryWeb3WalletId: null,
//   publicMetadata: { accountType: "admin" },
//   removePassword: [Function],
//   samlAccounts: [],
//   setProfileImage: [Function],
//   totpEnabled: false,
//   twoFactorEnabled: false,
//   unsafeMetadata: {},
//   update: [Function],
//   updatePassword: [Function],
//   updatedAt: "",
//   username: null,
//   verifyTOTP: [Function],
//   web3Wallets: [],
// };
