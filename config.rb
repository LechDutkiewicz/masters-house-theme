# Set this to the root of your project when deployed:
require "fileutils"
    
# on_stylesheet_saved do |file|
#   if File.exists?(file)
#     filename = File.basename(file, File.extname(file))
#     File.rename(file, css_dir + "/" + filename + ".min" + File.extname(file))
#   end
# end

preferred_syntax = :sass
http_path = "/"
css_dir = "assets/css/colors"
sass_dir = "sass"
images_dir = "assets/images/"
javascripts_dir = ""
relative_assets = true

output_style = :compressed
environment = :production
