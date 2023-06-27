import { LocalStorage } from "quasar";
import { useRouter } from "vue-router";
let VerifToken = (pageRedirect) => {
  const router = useRouter();
  let token = LocalStorage.getItem("token");
  if (!token) {
    router.push(`${pageRedirect}`);
  } else {
    return token;
  }
};

export default VerifToken;
