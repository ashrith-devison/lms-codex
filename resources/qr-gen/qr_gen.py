import qrcode as qr
import sys


img = qr.make(sys.argv[1])

# Save the QR code image
img_name = sys.argv[2] + ".png"
img.save("../../tempo/"+img_name)
print("success")

