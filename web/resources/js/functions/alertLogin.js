export const alertLogin = (isLogin) => {
  if (!isLogin) {
    alert('いいね機能を使うにはログインしてください。');
    return;
  }
};
