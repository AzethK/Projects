package rockpaperscissors;

import java.io.BufferedReader;
import java.io.DataInputStream;
import java.io.FileInputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.List;
import javax.swing.Icon;
import javax.swing.ImageIcon;

public class Cutscene {

    public ImageIcon[] cutsceneIcon = new ImageIcon[10];
    public int maxDialogue = 0;
    public String[] csSongs = new String[10];
    List<String> lines = new ArrayList<String>();
    public String[] cutscene = null;
    public int csTrigger[] = new int[10];
    public int maxTrigger=0;

    public Cutscene(int n) {
        loadDialogue(n);
        if(n==0){
            maxTrigger=2;
            csTrigger[0]=4;
            csTrigger[1]=12;
            cutsceneIcon[0]= new ImageIcon("src/res/backgrounds/background1.png");
            cutsceneIcon[1]= new ImageIcon("src/res/backgrounds/background2.png");
            cutsceneIcon[2]= new ImageIcon("src/res/backgrounds/background4.png");
            csSongs[0]="src/res/music/bgm2.wav";
            csSongs[1]="src/res/music/bgm2.wav";
        }
        if(n==1){
            maxTrigger=0;
            cutsceneIcon[0]= new ImageIcon("src/res/backgrounds/background2.png");
            csSongs[0]="src/res/music/bgm2.wav";
        }
    }

    Cutscene() {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

    public void loadDialogue(int n) {
        try {
            FileInputStream fstream_dialogue = new FileInputStream("src/res/cutscene/Cutscene" + n + ".txt");
            DataInputStream data_input = new DataInputStream(fstream_dialogue);
            BufferedReader buffer = new BufferedReader(new InputStreamReader(data_input));
            String str_line;

            while ((str_line = buffer.readLine()) != null) {
                str_line = str_line.trim();
                if ((str_line.length() != 0)) {
                    lines.add(str_line);
                    maxDialogue++;
                }
            }
            cutscene = (String[]) lines.toArray(new String[lines.size()]);
            lines.clear();
        } catch (Exception e) {
            // Catch exception if any
            System.err.println("Error: " + e.getMessage());
        }
    }
}
