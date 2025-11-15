import requests
from bs4 import BeautifulSoup
import pandas as pd

url = "https://lp3m.unimal.ac.id/akreditasi/hasil-akreditasi"
response = requests.get(url)
soup = BeautifulSoup(response.text, 'html.parser')

table = soup.find("table")

data = []

for tr in table.find_all("tr"):
    tds = tr.find_all("td")

    # Skip jika bukan row data (td < 7)
    if len(tds) < 7:
        continue

    # Ambil link download
    link_tag = tds[-1].find("a")
    link = link_tag["href"] if link_tag else None

    data.append({
        "No": tds[0].get_text(strip=True),
        "Program Pendidikan": tds[1].get_text(strip=True),
        "Prodi": tds[2].get_text(strip=True),
        "Peringkat": tds[3].get_text(strip=True),
        "Nomor SK": tds[4].get_text(strip=True),
        "Tahun SK": tds[5].get_text(strip=True),
        "Masa Berlaku": tds[6].get_text(strip=True),
        "Link Sertifikat": link,
    })

df = pd.DataFrame(data)
print(df)
df.to_csv("akreditasi_unimal.csv", index=False)
