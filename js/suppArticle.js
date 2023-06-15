/* Remplace une chaîne. */

function suppArticle(strr) {
  strr = strr.replace(" (le)", "");
  strr = strr.replace(" (Le)", "");
  strr = strr.replace(" (La)", "");
  strr = strr.replace(" (la)", "");
  strr = strr.replace(" (L')", "");
  strr = strr.replace(" (l')", "");
  return strr;
}